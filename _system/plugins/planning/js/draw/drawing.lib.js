"use strict";
function Point(x, y) {
    var scope = this;

    scope.x = x || 0;
    scope.y = y || 0;

    scope.clone = function() {
        return new Point(scope.x, scope.y);
    };
    scope.scale = function(sx, sy) {
        sx = sx || 1;
        sy = sy || sx;
        return new Point(scope.x * sx, scope.y * sy);
    };
    scope.translate = function(dx, dy) {
        return new Point(scope.x + dx, scope.y + dy);
    };
}
Point.prototype.equals = function(other) {
    return this.x == other.x && this.y == other.y;
};
Point.distance = function(a, b) {
    return Math.sqrt((b.x - a.x) * (b.x - a.x) + (b.y - a.y) * (b.y - a.y));
};

"use strict";
var PointUtils = {};

PointUtils.drawPoint = function(context, point, radius, fill) {
    radius = radius || 2;

    context.beginPath();
    context.arc(point.x, point.y, radius, 0, 2 * Math.PI);
    if ( fill ) context.fill();
    else context.stroke();
};
PointUtils.drawPoints = function(context, points, radius, fill, useNumber) {
    radius = radius || 2;

    for ( var i = 0, t = points.length; i < t; i++ ) {
        var p = points[i];

        PointUtils.drawPoint(context, p, radius, fill);

        if ( useNumber ) {
            context.fillText(i, p.x + radius / 2 + 5, p.y + 5);
        }
    }
};
PointUtils.drawContour = function(context, points, fill) {
    context.beginPath();
    context.moveTo(points[0].x, points[0].y);
    for ( var i = 0, l = points.length; i < l; i++ ) context.lineTo(points[i].x, points[i].y);
    context.lineTo(points[0].x, points[0].y);
    if ( fill ) context.fill();
    else context.stroke();
};
PointUtils.getAngle = function(a, b) {
    var dx = b.x - a.x;
    var dy = b.y - a.y;

    if ( dy == 0 ) {
        if ( dx > 0 ) return 0;
        else return Math.PI;
    }

    return Math.atan2(dy, dx);
};
PointUtils.getNearPoint = function(pivot, points, radius, dx, dy, sx, sy) {
    if ( points.length == 0 ) return;

    radius = radius || 0;
    dx = dx || 0;
    dy = dy || 0;
    sx = sx || 1;
    sy = sy || 1;

    var point = points[0];
    var distance = Point.distance(pivot, point.scale(sx, sy).translate(dx, dy));

    for ( var i = 1, t = points.length; i < t; i++ ) {
        var p = points[i];
        var d = Point.distance(pivot, p.scale(sx, sy).translate(dx, dy));

        if ( d < distance ) {
            distance = d;
            point = p;
        }
    }

    if ( distance < radius ) return point;

    return null;
};

/** Counter maker */
function ContourMaker( data ) {
    data = data || {};
    var scope = this;
    var scaleMin = .25;
    var scaleMax = 7;
    var scalesSteps = 20;
    var scaleStep = (scaleMax - scaleMin) / scalesSteps;
    var scale = 1;
    var deltaX = 0;
    var deltaY = 0;
    var width = 800;
    var height = 600;
    var imageWidth = 0;
    var imageHeight = 0;
    var points = [];
    var pointsEdge = [];
    var canvas = data.canvas || document.createElement("canvas");
    var context = canvas.getContext("2d");
    var bounds = null;
    var image = null;
    var pointDown = null;
    var pointMouse = null;
    var pointVertexUnderCursor = null;
    var pointEdgeUnderCursor = null;
    var mouseRadiusScanPoints = 5;
    var drawing = false;

    var axisX = null;
    var axisY = null;

    //setup
    canvas.setAttribute("oncontextmenu", "return false");

    // events and handlers
    canvas.addEventListener("mousedown", mouseDownHandler);
    canvas.addEventListener("mousemove", mouseMoveHandler);
    canvas.addEventListener("wheel", mouseWheelHandler);
    canvas.addEventListener("mouseout", mouseOutHandler);

    function mouseOutHandler(event) {
        pointMouse = null;

        updateGraphics();
    }
    function mouseWheelHandler(event) {
        if ( event.deltaY == 0 ) return;

        var point = getMousePoint(event);
        var mdx = point.x - deltaX;
        var mdy = point.y - deltaY;
        var odx = mdx / scale;
        var ody = mdy / scale;
        var ndx, ndy;

        scale += ( event.deltaY < 0 ) ? scaleStep : -scaleStep;

        if ( scale < scaleMin ) scale = scaleMin;
        else if ( scale > scaleMax ) scale = scaleMax;

        ndx = odx * scale;
        ndy = ody * scale;

        deltaX -= ndx - mdx;
        deltaY -= ndy - mdy;

        updateGraphics();
    }
    function mouseMoveHandler(event) {
        pointMouse = getMousePoint(event);

        if ( pointMouse.x >= 0 && pointMouse.x <= width && pointMouse.y >= 0 && pointMouse.y <= height ) {
            if ( drawing ) {
                pointMouse = alignPoint(pointMouse);
                pointVertexUnderCursor = null;
                pointEdgeUnderCursor = null;
            } else {
                scanNearPoint(pointMouse);
            }
        } else pointMouse = null;

        updateGraphics();
    }
    function mouseDownHandler(event) {
        var button = event.which;

        if ( button == 1 ) {
            if ( drawing ) mouseLeftDownHandler(event);
            else if ( pointVertexUnderCursor ) mouseLeftDownMovePointHandler(event);
            else if ( pointEdgeUnderCursor ) mouseLeftDownMovePointEdgeHandler(event);
        }
        else if ( button == 3 ) {
            if ( pointVertexUnderCursor ) mouseRightDownRemovePointVertexHandler(event);
            else mouseRightDownHandler(event);
        }
    }
    // mouse right remove point vertex
    function mouseRightDownRemovePointVertexHandler(event) {
        canvas.removeEventListener("mousemove", mouseMoveHandler);
        canvas.removeEventListener("mousedown", mouseDownHandler);

        pointDown = getMousePoint(event);

        window.addEventListener("mouseup", mouseRightUpRemovePointVertexHandler);
        window.addEventListener("mousemove", mouseRightMoveRemovePointVertexHandler);
    }
    function mouseRightUpRemovePointVertexHandler(event) {
        mouseRightMoveRemovePointVertexHandler(event);

        removeCurrentPointVertex();
    }
    function mouseRightMoveRemovePointVertexHandler(event) {
        if ( Point.distance(pointDown, getMousePoint(event)) > 2 ) {
            window.removeEventListener("mouseup", mouseRightUpRemovePointVertexHandler);
            window.removeEventListener("mousemove", mouseRightMoveRemovePointVertexHandler);

            canvas.addEventListener("mousemove", mouseMoveHandler);
            canvas.addEventListener("mousedown", mouseDownHandler);
        }
    }
    //mouse right
    function mouseRightDownHandler(event) {
        canvas.removeEventListener("mousemove", mouseMoveHandler);
        canvas.removeEventListener("mousedown", mouseDownHandler);
        window.addEventListener("mouseup", mouseRightUpHandler);
        window.addEventListener("mousemove", mouseRightMoveHandler);

        pointMouse = null;
        pointDown = getMousePoint(event);
    }
    function mouseRightMoveHandler(event) {
        var pm = getMousePoint(event);

        deltaX += pm.x - pointDown.x;
        deltaY += pm.y - pointDown.y;

        pointDown = pm;

        updateGraphics();
    }
    function mouseRightUpHandler(event) {
        if ( event.which != 3 ) return;

        window.removeEventListener("mousemove", mouseRightMoveHandler);
        window.removeEventListener("mouseup", mouseRightUpHandler);
        canvas.addEventListener("mousedown", mouseDownHandler);
        canvas.addEventListener("mousemove", mouseMoveHandler);
    }
    //end mouse right
    // mouse left move point
    function mouseLeftDownMovePointHandler(event) {
        canvas.removeEventListener("mousemove", mouseMoveHandler);
        canvas.removeEventListener("mousedown", mouseDownHandler);
        window.addEventListener("mouseup", mouseLeftUpMovePointHandler);
        window.addEventListener("mousemove", mouseLeftMoveMovePointHandler);

        pointDown = getMousePoint(event);
    }
    function mouseLeftUpMovePointHandler(event) {
        window.removeEventListener("mouseup", mouseLeftUpMovePointHandler);
        window.removeEventListener("mousemove", mouseLeftMoveMovePointHandler);
        canvas.addEventListener("mousemove", mouseMoveHandler);
        canvas.addEventListener("mousedown", mouseDownHandler);

        axisX = null;
        axisY = null;
    }
    function mouseLeftMoveMovePointHandler(event) {
        var point = getMousePoint(event);

        point = alignPoint(point, pointVertexUnderCursor);

        pointVertexUnderCursor.x = (point.x - deltaX) / scale;
        pointVertexUnderCursor.y = (point.y - deltaY) / scale;

        updatePointsEdge();
        updateGraphics();
    }
    // end mouse left move cursor
    // mouse left move edge cursor
    function mouseLeftDownMovePointEdgeHandler(event) {
        var index;
        var newVertex;

        if ( pointEdgeUnderCursor == null ) return;

        index = pointsEdge.indexOf(pointEdgeUnderCursor);

        if ( index < 0 ) return;

        newVertex = getMousePoint(event);

        addPointToContour(newVertex, index + 1);

        pointEdgeUnderCursor = null;
        pointVertexUnderCursor = newVertex;

        updatePointsEdge();
        updateGraphics();
        mouseLeftDownMovePointHandler(event);
    }
    //mouse left
    function mouseLeftDownHandler(event) {
        canvas.removeEventListener("mousedown", mouseDownHandler);
        window.addEventListener("mouseup", mouseLeftUpHandler);

        pointDown = getMousePoint(event);
        pointDown = alignPoint(pointDown);
    }
    function mouseLeftUpHandler(event) {
        if ( event.which != 1 ) return;

        window.removeEventListener("mouseup", mouseLeftUpHandler);
        canvas.addEventListener("mousedown", mouseDownHandler);

        addPointToContour(pointDown);
        pointDown = null;
        axisX = null;
        axisY = null;
    }
    // end mouse left


    // private
    function addPointToContour(point, place) {
        place = place || -1;

        if ( point.x >= 0 && point.x <= width && point.y >= 0 && point.y <= height ) {
            point.x -= deltaX;
            point.y -= deltaY;
            point.x /= scale;
            point.y /= scale;

            if ( !pointExist(point, points, 3 / scale) ) {
                if ( place < 0 ) points.push(point);
                else points.splice(place, 0, point);
            }

            updateGraphics();
        }
    }

    function alignPoint(source, except) {
        var point;
        var delta = scope.aligmentSize * scale;
        var minDeltaX = 0;
        var minDeltaY = 0;
        var pAxisX = null;
        var pAxisY = null;
        var p, dx, dy;

        if ( !scope.aligment || points.length == 0 ) return source;

        point = source.clone().translate(-deltaX, -deltaY).scale(1 / scale);
        p = points[0] == except ? points[1] : points[0];
        pAxisX = p;
        pAxisY = p;
        minDeltaX = point.x - p.x;
        minDeltaY = point.y - p.y;

        for ( var i = 0, l = points.length; i < l; i++ ) {
            p = points[i];

            if ( p == except ) continue;

            dx = point.x - p.x;
            dy = point.y - p.y;

            if ( Math.abs(dx) < Math.abs(minDeltaX) ) {
                minDeltaX = dx;
                pAxisX = p;
            }
            if ( Math.abs(dy) < Math.abs(minDeltaY) ) {
                minDeltaY = dy;
                pAxisY = p;
            }
        }

        if ( Math.abs(minDeltaX) < delta ) {
            axisX = { x:pAxisX.x, ya:pAxisX.y, yb:point.y };
        } else {
            axisX = null;
            minDeltaX = 0;
        }

        if ( Math.abs(minDeltaY) < delta ) {
            axisY = { y:pAxisY.y, xa:pAxisY.x, xb:point.x };
        } else {
            axisY = null;
            minDeltaY = 0;
        }

        point = new Point(point.x - minDeltaX, point.y - minDeltaY);

        if ( axisX ) axisX.yb = point.y;
        if ( axisY ) axisY.xb = point.x;

        point = point.scale(scale, scale).translate(deltaX, deltaY);

        return point;
    }
    function pointExist(point, points, eps) {
        eps = eps || 0;

        for ( var i = 0, l = points.length; i < l; i++ ) {
            if ( Math.abs(point.x - points[i].x) < eps && Math.abs(point.y - points[i].y) < eps ) return true;
        }

        return false;
    }

    function removeCurrentPointVertex() {
        if ( pointVertexUnderCursor == null ) return;

        var index = points.indexOf(pointVertexUnderCursor);

        if ( index < 0 ) return;

        points.splice(index, 1);

        pointVertexUnderCursor = null;

        updatePointsEdge();
        updateGraphics();
    }
    function updatePointsEdge() {
        var pa, pb, pe;

        pointsEdge = [];

        if ( points.length < 3 ) return;

        for ( var i = 1, l = points.length; i < l; i++) {
            pa = points[i -1];
            pb = points[i];
            pe = new Point((pb.x - pa.x) / 2 + pa.x, (pb.y - pa.y) / 2 + pa.y);

            pointsEdge.push(pe);
        }

        pa = points[i - 1];
        pb = points[0];
        pe = new Point((pb.x - pa.x) / 2 + pa.x, (pb.y - pa.y) / 2 + pa.y);

        pointsEdge.push(pe);
    }
    function getMousePoint(event) {
        updateBoundsCanvas();

        return new Point(event.clientX - bounds.left, event.clientY - bounds.top);
    }
    function scanNearPoint(position) {
        pointVertexUnderCursor = PointUtils.getNearPoint(position, points, mouseRadiusScanPoints, deltaX, deltaY, scale, scale);
        pointEdgeUnderCursor = PointUtils.getNearPoint(position, pointsEdge, mouseRadiusScanPoints, deltaX, deltaY, scale, scale);
    }
    function updateBoundsCanvas() {
        bounds = canvas.getBoundingClientRect();
    }
    function updateSize() {
        canvas.width = width;
        canvas.height = height;
    }
    function updateGraphics() {
        context.clearRect(0, 0, width, height);

        drawImage();
        drawDataPoints();
    }
    function drawImage() {
        context.drawImage(image, deltaX, deltaY, imageWidth * scale, imageHeight * scale);
    }
    function drawContour() {
        if ( drawing ) {
            context.strokeStyle = scope.countorStrokeStyleDrawing;
        } else {
            context.strokeStyle = scope.countorStrokeStyleEditing;
        }

        context.fillStyle = scope.countorFillStyle;
        context.setLineDash([]);

        if ( points.length >= 2 ) {
            context.beginPath();
            context.moveTo(deltaX + points[0].x * scale, deltaY + points[0].y * scale);
            for (var i = 1, l = points.length; i < l; i++) {
                context.lineTo(deltaX + points[i].x * scale, deltaY + points[i].y * scale);
            }
            if ( drawing && pointMouse != null) {
                context.lineTo(pointMouse.x, pointMouse.y);
            }
            context.lineTo(deltaX + points[0].x * scale, deltaY + points[0].y * scale);
            context.stroke();
            context.fill();
        } else if ( points.length > 0 ) {
            context.beginPath();
            context.moveTo(deltaX + points[0].x * scale, deltaY + points[0].y * scale);
            if ( drawing && pointMouse != null) {
                context.lineTo(pointMouse.x, pointMouse.y);
            }
            context.stroke();
        }
    }
    function drawPoints() {
        var radiusVertex, radiusEdge;

        if ( drawing ) {
            radiusVertex = 3;
            radiusEdge = 0;
        } else {
            radiusVertex = 4;
            radiusEdge = 2;
        }

        context.fillStyle = scope.pointEdgeFillStyle;

        for ( var i = 0, l = pointsEdge.length; i < l; i++ ) {
            var p = pointsEdge[i];

            context.beginPath();
            context.arc(deltaX + p.x * scale, deltaY + p.y * scale, radiusEdge, 0, Math.PI * 2);
            context.fill();
        }

        context.fillStyle = scope.pointVertexFillStyle;

        for ( var i = 0, l = points.length; i < l; i++ ) {
            var p = points[i];

            context.beginPath();
            context.arc(deltaX + p.x * scale, deltaY + p.y * scale, radiusVertex, 0, Math.PI * 2);
            context.fill();
        }

        if ( pointEdgeUnderCursor != null ) {
            context.fillStyle = scope.pointVertexUnderCursorFillStyle;
            context.beginPath();
            context.arc(deltaX + pointEdgeUnderCursor.x * scale, deltaY + pointEdgeUnderCursor.y * scale, 4, 0, Math.PI * 2);
            context.fill();
        }
        if ( pointVertexUnderCursor != null ) {
            context.fillStyle = scope.pointEdgeUnderCursorFillStyle;
            context.beginPath();
            context.arc(deltaX + pointVertexUnderCursor.x * scale, deltaY + pointVertexUnderCursor.y * scale, 5, 0, Math.PI * 2);
            context.fill();
        }
    }
    function drawHints() {
        if ( axisX ) {
            context.beginPath();
            context.strokeStyle = scope.hintsStrokeStyle;
            context.setLineDash([5]);
            context.moveTo(axisX.x * scale + deltaX, axisX.ya * scale + deltaY);
            context.lineTo(axisX.x * scale + deltaX, axisX.yb * scale + deltaY);
            context.stroke();
        }
        if ( axisY ) {
            context.beginPath();
            context.strokeStyle = scope.hintsStrokeStyle;
            context.setLineDash([5]);
            context.moveTo(axisY.xa * scale + deltaX, axisY.y * scale + deltaY);
            context.lineTo(axisY.xb * scale + deltaX, axisY.y * scale + deltaY);
            context.stroke();
        }
    }
    function drawDataPoints() {
        drawContour();
        drawPoints();
        drawHints();

        context.fillStyle = "#444444";
        context.strokeStyle = "#444444";
        if ( pointMouse != null ) PointUtils.drawPoint(context, pointMouse, 2, true);
    }
    function updatePoints(pts) {
        points = pts;

        updatePointsEdge();
        updateGraphics();
    }

    // public
    scope.pointVertexFillStyle = "#530053";
    scope.pointEdgeFillStyle = "#530053";
    scope.hintsStrokeStyle = "#00FF00";
    scope.pointVertexUnderCursorFillStyle = "#FF0000";
    scope.pointEdgeUnderCursorFillStyle = "#FF0000";
    scope.countorStrokeStyleDrawing = "#FF00FF";
    scope.countorStrokeStyleEditing = "#FF00FF";
    scope.countorFillStyle = "rgba(255, 0, 255, .3)";
    scope.aligment = true;
    scope.aligmentSize = 10;

    scope.clear = function() {
        points = [];

        updatePointsEdge();
        updateGraphics();
    };
    scope.removeLast = function() {
        if ( !drawing ) return;
        if ( points.length == 0 ) return;

        points.pop();

        updatePoints(points);
    };
    scope.draw = function() {
        if ( drawing ) return;

        drawing = true;

        updateGraphics();
    };
    scope.edit = function() {
        if ( !drawing ) return;

        drawing = false;

        updatePointsEdge();
        updateGraphics();
    };
    scope.setSize = function(w, h) {
        width = w;
        height = h;

        updateSize();
    };
    scope.__defineGetter__("width", function() {
        return width;
    });
    scope.__defineSetter__("width", function(value){
        width = value;

        updateSize();
    });
    scope.__defineGetter__("height", function() {
        return height;
    });
    scope.__defineSetter__("height", function(value){
        height = value;

        updateSize();
    });
    scope.__defineGetter__("domElement", function() {
        return canvas;
    });
    scope.__defineGetter__("image", function(){
        return image;
    });
    scope.__defineSetter__("image", function(value) {
        image = value;
        imageWidth = image.width;
        imageHeight = image.height;

        updateGraphics();
    });
    scope.__defineGetter__("isDrawing", function(){
        return drawing;
    });
    scope.__defineGetter__("isEditing", function(){
        return !drawing;
    });
    scope.getPointsString = function(divider) {
        if ( points.length == 0 ) return;

        divider = divider || ",";

        var string = "";
        var last = points.length - 1;
        var i;
        var p;

        for ( i = 0; i < last; i++ ) {
            p = points[i];
            string += Math.round(p.x) + divider + Math.round(p.y) + divider;
        }

        p = points[last];
        string += Math.round(p.x) + divider + Math.round(p.y);

        return string;
    };
    scope.setPointsFromString = function(string, separator) {
        var elements;
        var pts;

        separator = separator || ",";

        elements = string.split(separator);

        if ( elements.length % 2 != 0 ) {
            console.log("String with data of points must contain coordinate of x and y. For example: 3 points are \"123,45,125,75,80,120\"");
            return;
        }

        pts = [];

        for ( var i = 0, l = elements.length; i < l; i += 2 ) {
            pts.push(new Point(parseInt(elements[i]), parseInt(elements[i + 1])));
        }

        updatePoints(pts);
    };
    scope.getPointsAsObjects = function() {
        var result = [];

        for ( var i = 0, l = points.length; i < l; i++ ) {
            result.push({
                x:points[i].x,
                y:points[i].y
            })
        }

        return result;
    };
    scope.setPointsFromObjects = function(objs) {
        if ( objs.length == 0 ) return;

        var pts = [];

        for ( var i = 0, l = objs.length; i < l; i++ ) {
            var obj = objs[i];

            if ( obj.hasOwnProperty("x") && obj.hasOwnProperty("y") ) pts.push(new Point(obj.x, obj.y));
            else {
                console.log("One object which define point must contain properties \"x\" and \"y\"");
                return;
            }
        }

        updatePoints(pts);
    };

    // init functions
    updateSize();
}

/** Init functions */
function initDraw (options) {

    var data = $.extend({
        canvasId        : 'canvas',
        controlPanelId  : 'control-panel-1',
        inputPathId     : 'planing-info-raphael-1',
        pathSvgFormat   : '',
        img             : '',
        popupId         : 'popup-drawing-1',
        runButtonId     : 'run-drawing-popup-1',
        closeButtonId   : 'close-drawing-popup-1',
        popupModalClass : 'wp-modal-draw'
    }, options)

    var contourMaker;
    var domElement;
    var image;
    var canvas;
    var popupDrawing;
    var popupModal;
    var runButton;
    var closeButton;
    var controlPanel;
    var inputPath;
    var currentPath;
    var buttonDeleteLast, buttonDraw, buttonEdit, buttonClear, buttons;
    var checkBoxAligment;
    var ptsAsStr;
    var imageUrl = null;
    var pathDraw = null;
    var width = 800;
    var height = 600;

    imageUrl = data.img;
    pathDraw = data.pathSvgFormat.replace(/M|Z|L|z/g, '');
    pathDraw = pathDraw.replace(/ /g, ',');

    width    = $(window).width() * 80 / 100;    // 80%
    height   = $(window).height() * 70 / 100;   // 70%

    canvas              = document.getElementById(data.canvasId);
    controlPanel        = document.getElementById(data.controlPanelId);
    inputPath           = document.getElementById(data.inputPathId);
    popupDrawing        = document.getElementById(data.popupId);
    popupModal          = document.getElementsByClassName(data.popupModalClass);
    runButton           = document.getElementById(data.runButtonId);
    closeButton         = document.getElementById(data.closeButtonId);

    buttonDeleteLast    = controlPanel.getElementsByClassName('delete-last')[0];
    buttonDraw          = controlPanel.getElementsByClassName("draw")[0];
    buttonEdit          = controlPanel.getElementsByClassName("edit")[0];
    buttonClear         = controlPanel.getElementsByClassName("clear")[0];
    checkBoxAligment    = controlPanel.getElementsByClassName("alignment")[0];
    ptsAsStr            = controlPanel.getElementsByClassName("ptsasstr")[0];
    buttons             = controlPanel.getElementsByClassName("buttons");

    contourMaker = new ContourMaker({canvas : canvas});
    contourMaker.setSize(width, height);
    domElement = contourMaker.domElement;
    domElement.className = "canvas";

    setClassActiveEditMode ();
    setParamsPopupModal (width, height);
    loadImg();

    buttonDeleteLast.addEventListener("click", clickDeleteLast);
    buttonDraw.addEventListener("click", clickDraw);
    buttonEdit.addEventListener("click", clickEdit);
    buttonClear.addEventListener("click", clickClear);
    checkBoxAligment.addEventListener("change", checkBoxChanged);
    ptsAsStr.addEventListener("click", getPointsAsString);
    runButton.addEventListener("click", runDrawingPopup);
    closeButton.addEventListener("click", closeDrawingPopup);

    function loadImg() {
        image = new Image();
        image.addEventListener("load", load);
        image.src = imageUrl;
    }

    function load(event) {
        contourMaker.image = image;
        contourMaker.setPointsFromString(pathDraw);
    }

    function clickDeleteLast(event) {
        contourMaker.removeLast();
    }
    function clickDraw(event) {
        contourMaker.draw();
        clearActiveClassButtons ();
        buttonDraw.className = buttonDraw.className + ' active';
    }
    function clickEdit(event) {
        contourMaker.edit();
        clearActiveClassButtons ();
        buttonEdit.className = buttonEdit.className + ' active';
    }
    function clickClear(event) {
        contourMaker.clear();
    }
    function checkBoxChanged(event) {
        contourMaker.aligment = event.target.checked;
    }
    function getPointsAsString(event) {
        currentPath = convertPolyToPath(contourMaker.getPointsString());
        inputPath.value = currentPath;
        closeButton.click();
        clearActiveClassButtons ();
        setClassActiveDrawMode ();
    }
    function clearActiveClassButtons () {
        for (var i=0; i<buttons.length; i++) {
            buttons[i].className = buttons[i].className.replace(/\bactive\b/,'');
        }
    }
    function setClassActiveEditMode () {
        if (pathDraw != "") {
            buttonEdit.className = buttonEdit.className + ' active';
        }
    }
    function setClassActiveDrawMode () {
        if (currentPath != "") {
            buttonDraw.className = buttonDraw.className + ' active';
        }
    }
    function convertPolyToPath(poly){
        if (typeof poly !== "undefined") {
            var p = poly.split(',');
            var pathdata;
            for (var i = 0; i < p.length; i++) {
                if(i==0){
                    pathdata = 'M'+p[i];
                }
                if(i==1){
                    pathdata += ' '+p[i];
                }
                if(i>1){
                    if(!(i%2)){
                        pathdata += ',L'+p[i]+' ';
                    } else {
                        pathdata += p[i];
                    }
                }
            }
            pathdata += 'Z';
            return pathdata;
        }
        return '';
    }

    function setParamsPopupModal (width) {
        for (var i=0; i < popupModal.length; i++) {
            popupModal[i].style.width = width + 'px';
        }
    }

    function runDrawingPopup () {
        popupDrawing.style.display = 'block';
    }
    function closeDrawingPopup () {
        popupDrawing.style.display = 'none';
    }
}
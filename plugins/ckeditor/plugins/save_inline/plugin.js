//-----------------------------------------------------------------------------
// Плагин Save для inlune editor
//-----------------------------------------------------------------------------
CKEDITOR.plugins.add('save_inline', {
  init : function(editor) {
    //Создаем кнопку
    editor.ui.addButton('Save', {
        label : 'Save text',                  //Alt на кнопке
        click : function () {                 //Click SAVE
            //Перебираем все редактируемые эл. 
            for(k in CKEDITOR.instances){
                //Элемент ..
                var instance = CKEDITOR.instances[k];
                //на save..
                saveEditorData(instance, k);
            }  
            //Сохранение .. 
            function saveEditorData(element_html, id) {
                CKEDITOR.disableAutoInline = true;
                //Маленькие перерыфф, что бы не грузить машину.. 
                setTimeout(function() {
                    //Узнаем какой эл. нам нужно save...
                    if(element_html.document.getById(id).hasClass('cke_focus')) {
                        //Текст для save
                        savedData = element_html.getData();
                        //Узнаем ID по id 
                        var save_id = $('#'+id).data('id');
                        //Поле для Save
                        var field = $('#'+id).data('field');
                        
                        if(id == false || field == false) {
                            alert("Не правильный параметры Online редактора!");
                            return false;
                        }
                        
                        /** Save AJAX  ***/
                        $.post(
                            '/applications/_ajax/online_editor.php',
                            {
                                id      : save_id,
                                text    : savedData,
                                field   : field
                            }, function(data) {
                                alert(' - ' + data + ' - ');
                            }
                        );
                        //Debug
                        //console.log('save - '+id);
                    }/* else {
                        alert('Error online Editor!!!');
                    }*/
                }, 100 );
            };  
        },
        icon: this.path + 'images/save.png'   //Img кнопки 
    });
    
    
    
    
  }
  
});
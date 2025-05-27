import './bootstrap';

import jQuery from 'jquery';
import 'jquery-mask-plugin';
window.$ = window.jQuery = jQuery;


//модальное окно для удаления карточки
$(document).ready(function(){
    $('#deleteModalBtn').click(function(){
        $('#deleteModal').modal('show');
    })

    //маска телефона
    $('#phone').mask('+7 (000) 000-00-00');

})


$(document).ready(function() {

    let btnOpen = $('.q-btn');
    let btnClose = $('.w-btn');

    btnOpen.click(function() {
        if (!$(this).hasClass('active')) {
            $(this).parent().parent().find('.question-descr').toggle('slow')
            $(this).parent().find('.q-btn').hide()
            $(this).parent().parent().find('.w-btn').toggle()
        }
    })

    btnClose.click(function() {
        if (!$(this).hasClass('active')) {
            $(this).parent().parent().find('.question-descr').toggle('slow')
            $(this).parent().find('.w-btn').hide()
            $(this).parent().parent().find('.q-btn').toggle()
        }
    })
});
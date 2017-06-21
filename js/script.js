$(document).ready(function() {

    $('.like').click(function() {

        var link = $(this).attr('href');
        var clicked = $(this);

        clicked.replaceWith('<button type="button" class="btn btn-primary btn-xs active"><span class="glyphicon glyphicon-heart"></span> You like this</button>');

        $.ajax({
            type: 'GET',
            url: link,
            dataType: 'html',
            complete: function(html) {
                clicked.replaceWith(html);
            }

        });

        return false;
    });


});


$(function() {

    var container = document.querySelector('#posts');
    var msnry = new Masonry(container, {
        // options
        itemSelector: '.item'
    });

    // layout Masonry again after all images have loaded
    $('#posts').imagesLoaded(container, function() {
        msnry.layout();
    });

});

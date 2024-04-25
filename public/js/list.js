$(document).ready(function () {


    // Back To Top Button
    function handleScrollDown() {
        $('#backToTopBtn').css('animation', 'bttShow 2s ease-out forwards');
    }

    $(window).scroll(function () {
        // Check if the user has scrolled down
        if ($(this).scrollTop() > 500) {
            // Call the function when scrolled down
            handleScrollDown();
        }

    });

    $('#backToTopBtn').click(function (e) {
        $('html, body').animate({ scrollTop: 0 }, 400);
        setTimeout(() => {
            $(this).css('animation', 'bttHide 2s ease-out forwards')
        }, 3000);
        return false;
    });

    $('#backToTopBtn').hover(function () {
        $('#backToTopBtn i').css('animation-duration', '300ms');

    }, function () {
        $('#backToTopBtn i').css('animation-duration', '1s');
    }
    );

    // Item and Category List Row Control
    $('#itemRoll').on('change', function () {
        $('#itemRollForm').submit();
    })

    $('#categoryRoll').on('change', function () {
        $('#categoryRollForm').submit();
    })

    // Live Toast
    const toastBootstrap = new bootstrap.Toast($('#liveToast'));

    toastBootstrap.show();


});

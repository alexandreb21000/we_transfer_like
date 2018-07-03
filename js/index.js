/*var $firstButton = $(".first"),
    $secondButton = $(".second"),
    $thirdButton = $(".third"),
    $fourdButton=$(".four")
    $input = $("input"),
    $name = $(".name"),
    $more = $(".more"),
    $yourname = $(".yourname"),
    $reset = $(".reset"),
    $ctr = $(".container");


$firstButton.on("click", function (e) {
    $(this).text("Saving...").delay(900).queue(function () {
        $ctr.addClass("center slider-two-active").removeClass("recipient slider-one-active ");
    });
    e.preventDefault();
});

$secondButton.on("click", function (e) {
    $(this).text("Saving...").delay(900).queue(function () {
        $ctr.addClass("full slider-three-active").removeClass("center slider-two-active slider-one-active slider-four-active");
        $name = $name.val();
        if ($name == "") {
            $yourname.html("Anonymous!");
        }
        else { $yourname.html($name + "!"); }
    });
    e.preventDefault();
});

$thirdButton.on("click", function (e) {
    $(this).text("Saving...").delay(900).queue(function () {
        $ctr.addClass("recipient slider-four-active").removeClass("full slider-three-active slider-two-active slider-one-active slider-four-active");
        $name = $name.val();
        if ($name == "") {
            $yourname.html("Anonymous!");
        }
        else { $yourname.html($name + "!"); }
    });
    e.preventDefault();
});

$fourdButton.on("click", function (e) {
    $(this).text("Saving...").delay(900).queue(function () {
        $ctr.addClass("recipient slider-four-active").removeClass("full slider-three-active slider-two-active slider-one-active slider-four-active");
        $name = $name.val();
        if ($name == "") {
            $yourname.html("Anonymous!");
        }
        else { $yourname.html($name + "!"); }
    });
    e.preventDefault();
});
*/

// copy
//balapaCop("Step by Step Form", "#999");

//function showHelp() {
//    var divHelp = document.getElementById('help');
//    divHelp.style.width = "30%";
//}
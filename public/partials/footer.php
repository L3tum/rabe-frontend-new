<?php

?>

<footer>
    <script
            src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossOrigin="anonymous"></script>
    <script
            src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossOrigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pwstrength-bootstrap/3.0.5/pwstrength-bootstrap.min.js"
            integrity="sha256-7SytMaZcLI/9SbsC89WX9DDRNXE15mSSYN7ttTsLJZc=" crossorigin="anonymous"></script>
    <script type="application/javascript">
        const strongRegex = new RegExp('^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})');

        $(':password').pwstrength({
            ui: {showVerdictsInsideProgressBar: true}
        });
        $(":password").pwstrength("addRule", "stronk", function (options, word, score) {
            return word.match(strongRegex) && score;
        }, 10, true);

        $('[data-toggle="tooltip"]').tooltip();
    </script>
</footer>

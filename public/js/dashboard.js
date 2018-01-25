var idMatches = {};

var substringMatcher = function (strs) {
    return function findMatches(q, cb) {
        var matches, substrRegex;

        // an array that will be populated with substring matches
        matches = [];

        // regex used to determine if a string contains the substring `q`
        substrRegex = new RegExp(q, 'i');

        // iterate through the pool of strings and for any string that
        // contains the substring `q`, add it to the `matches` array
        $.each(strs, function (i, str) {
            if (substrRegex.test(str)) {

                //convert to use json object
                var stringLength = str.length;
                var spanArea = str.indexOf('<span>');
                var endSpanArea = str.indexOf('</span>');
                var profileID = str.substring(spanArea + 6, endSpanArea);

                var stringName = str.substring(0, spanArea);

                // the typeahead jQuery plugin expects suggestions to a
                // JavaScript object, refer to typeahead docs for more info
                matches.push({value: stringName, id: profileID});
            }
        });

        cb(matches);
    };
};

$(document).ready(function () {

    $('.click_and_remember').click(function () {
        $(this).val('');
    });

    $('#search').focus(function(){
        $(this).siblings('.tt-hint').css('width', '210px');
    });

    $('#search').blur(function(){
        $(this).siblings('.tt-hint').css('width', '100px');
    });

    $('#search').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        },
        {
            name: 'people',
            displayKey: 'value',
            source: substringMatcher(people),
            templates: {

            }
        }
    ).on('typeahead:selected', function (e, selection) {
        window.location = '/users/view/'+selection.id;
    })

})
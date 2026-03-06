
// (function ($) {
//     "use strict";
//     var toc = function (options) {
//         return this.each(function () {
//             var root = $(this),
//                 data = root.data(),
//                 thisOptions,
//                 stack = [root], // The upside-down stack keeps track of list elements
//                 listTag = this.tagName,
//                 currentLevel = 0,
//                 headingSelectors;

//             // Defaults: plugin parameters override data attributes, which override our defaults
//             thisOptions = $.extend(
//                 {content: "body", headings: "h2"},
//                 {content: data.toc || undefined, headings: data.tocHeadings || undefined},
//                 options
//             );
//             headingSelectors = thisOptions.headings.split(",");

//             // Set up some automatic IDs if we do not already have them
//             $(thisOptions.content).find(thisOptions.headings).attr("id", function (index, attr) {
//                 var generateUniqueId = function (text) {
//                     if (text.length === 0) {
//                         text = "?";
//                     }

//                     var baseId = text.replace(/\s+|:|,|!|%|\?|\(|\)|\&/g, "_"), suffix = "", count = 1;

//                     while (document.getElementById(baseId + suffix) !== null) {
//                         suffix = "_" + count++;
//                     }

//                     return baseId + suffix;
//                 };

//                 return attr || generateUniqueId($(this).text());
//             }).each(function () {
//                 // What level is the current heading?
//                 var elem = $(this), level = $.map(headingSelectors, function (selector, index) {
//                     return elem.is(selector) ? index : undefined;
//                 })[0];

//                 if (level > currentLevel) {
//                     var parentItem = stack[0].children("li:last")[0];
//                     if (parentItem) {
//                         stack.unshift($("<" + listTag + "/>").appendTo(parentItem));
//                     }
//                 } else {
//                     stack.splice(0, Math.min(currentLevel - level, Math.max(stack.length - 1, 0)));
//                 }

//                 // Add the list item
//                 $("<li/>").appendTo(stack[0]).append(
//                     $("<a/>").text(elem.text()).attr("href", "#" + elem.attr("id"))
//                 );
//                 currentLevel = level;
//             });
//         });
//     }, old = $.fn.toc;

//     $.fn.toc = toc;

//     $.fn.toc.noConflict = function () {
//         $.fn.toc = old;
//         return this;
//     };

//     // Data API
//     $(function () {
//         toc.call($("[data-toc]"));
//     });

//     $(document).on('click', function(e) {
//         $('#toc').click(function(){
//             $('.list-toc').addClass('d-none');
//         });
//         $('.button-select').click(function(){
//             $('.list-toc').removeClass('d-none');
//         });

//     });
// }(window.jQuery));

(function ($) {
    "use strict";
    var toc = function (options) {
        return this.each(function () {
            var root = $(this),
                data = root.data(),
                thisOptions,
                stack = [root],
                listTag = this.tagName,
                currentLevel = 0,
                headingSelectors,
                numbering = []; // Array to keep track of numbering

            // Combine defaults, data attributes, and options
            thisOptions = $.extend(
                { content: "body", headings: "h2" },
                { content: data.toc || undefined, headings: data.tocHeadings || undefined },
                options
            );
            headingSelectors = thisOptions.headings.split(",");

            // Set unique IDs for headings if they don't have them
            $(thisOptions.content).find(thisOptions.headings).attr("id", function (index, attr) {
                var generateUniqueId = function (text) {
                    if (text.length === 0) {
                        text = "?";
                    }
                    var baseId = text.replace(/\s+|:|,|!|%|\?|\(|\)|\&/g, "_"),
                        suffix = "",
                        count = 1;

                    while (document.getElementById(baseId + suffix) !== null) {
                        suffix = "_" + count++;
                    }
                    return baseId + suffix;
                };
                return attr || generateUniqueId($(this).text());
            }).each(function () {
                var elem = $(this), level = $.map(headingSelectors, function (selector, index) {
                    return elem.is(selector) ? index : undefined;
                })[0];

                // Manage nested list structure
                if (level > currentLevel) {
                    var parentItem = stack[0].children("li:last")[0];
                    if (parentItem) {
                        stack.unshift($("<" + listTag + "/>").appendTo(parentItem));
                    }
                } else {
                    stack.splice(0, Math.min(currentLevel - level, Math.max(stack.length - 1, 0)));
                }

                // Update numbering
                numbering[level] = (numbering[level] || 0) + 1;
                if (level < currentLevel) {
                    numbering = numbering.slice(0, level + 1);
                }
                currentLevel = level;

                // Generate the numbering string
                var numberingString = numbering.slice(0, level + 1).join('.').substring(1) + '.';
                // var numberingString = numbering.slice(0, level + 1).join('.');
                // if (numberingString.startsWith('.')) {
                //     numberingString = numberingString.substring(1);
                // }


                // Add the list item with numbering
                $("<li/>").appendTo(stack[0]).append(
                    $("<a/>").text(numberingString + ' ' + elem.text()).attr("href", "#" + elem.attr("id"))
                );
            });
        });
    }, old = $.fn.toc;

    $.fn.toc = toc;

    $.fn.toc.noConflict = function () {
        $.fn.toc = old;
        return this;
    };

    // Data API
    $(function () {
        toc.call($("[data-toc]"));
    });

    // Click event handlers
    $(document).on('click', function (e) {
        $('#toc').click(function () {
            $('.list-toc').addClass('d-none');
        });
        $('.button-select').click(function () {
            $('.list-toc').removeClass('d-none');
        });
    });
}(window.jQuery));

<?php
/**
 * @var $engine \App\ViewRenderer
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/15/2017
 * Time: 1:45 AM
 */
use App\FormHelper;

?>
<?= FormHelper::start($engine->route("/admin/books"), "post", "Add book") ?>
<?= FormHelper::input("text", "title", "title", "Title"); ?>
<?= FormHelper::input("text", "link", "link", "Link"); ?>
<?= FormHelper::input("text", "thumbnail", "thumbnail", "Thumbnail"); ?>
<?= FormHelper::input("select", "category_id", "category_id", "Category", ['value' => $request->viewbag('categories', [])]); ?>

<hr>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Preview</h3>
    </div>
    <div class="panel-body" id="preview">
    </div>
</div>
<hr>

<div class="form-group">
    <div class="col-sm-4 col-sm-offset-4">
        <div class="btn-group">
            <button type="submit" id="b_add" name="add" value="true" disabled="disabled" class="btn btn-lg btn-primary">
                Add
            </button>
            <button type="button" id="b_suggestions" class="btn btn-lg btn-default">
                Suggestions
            </button>
        </div>
    </div>
</div>
<hr>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Suggestions</h3>
    </div>
    <div class="panel-body" id="suggestions">
    </div>
</div>
<?= FormHelper::end() ?>
<?php $engine->inlineJS() ?>
<script>
    "use strict";

    (function () {
        function c() {
            var title = $("#title").val();
            var link = $("#link").val();
            var thumbnail = $("#thumbnail").val();

            var $category = $("#category_id");

            var category = $category.val();
            var categoryText = $category.find("option:selected").text();

            var $b = $("#b_add");
            if (!title || !link || !thumbnail || !category) {
                $b.attr('disabled', 'disabled');
                return;
            }

            $b.removeAttr('disabled');

            $("#preview").html(
                "<div class='row'>" +
                "<div class=\'col-sm-offset-3 col-sm-6 story\'>" +
                "<div class='well'>" +
                "<a href=\'" +
                link +
                "\' target=\'_blank\'>" +
                "<div class=\'row\'>" +
                "<div class=\'col-sm-6\'>" +
                "<img class=\'img-responsive\' src=\'" + thumbnail + "\'/>" +
                "</div>" +
                "<div class=\'col-sm-6\'>" +
                title +
                "</div>" +
                "</div>" +
                "</a>" +
                "<hr>" +
                "<span class='thedate'>" +
                new Date().toISOString().slice(0, 19).replace('T', ' ') +
                "</span>" +
                "<span class='pull-right'>" +
                "<span class='category'>" +
                categoryText +
                "</span>" +
                "</span>" +
                "</div>" +
                "</div>" +
                "</div>");
        }

        $("#title").change(c);
        $("#link").change(c);
        $("#thumbnail").change(c);
        $("#category_id").change(c);

        setInterval(function () {
            var $f = $(".thedate");
            if ($f)
                $f.html(new Date().toISOString().slice(0, 19).replace('T', ' '));
        }, 1000 / 3);
    })();

    (function () {
        function g(e) {
            var $f = $(this);
            e.preventDefault();
            e.stopPropagation();
            $("#title").val($f.find('.col-sm-9').html()).trigger('change');
            $("#link").val($f.find('a').attr('href')).trigger('change');
            $("#thumbnail").val($f.find('img').attr('src')).trigger('change');
            return false;
        }

        $("#b_suggestions").click(function () {
            var $b = $(this);
            $b.attr("disabled", "disabled");
            $.get('books?suggestions', function (data) {
                var i, item;
                var html = "<div class='row'>";

                var $suggestions = $("#suggestions");
                $suggestions.html("");

                for (i = 0; i < data.length; i++) {
                    item = data[i];
                    html +=
                        "<div class=\'col-sm-4 item\'>" +
                        "<a href=\'" +
                        item['link'] +
                        "\' target=\'_blank\'>" +
                        "<div class=\'row\'>" +
                        "<div class=\'col-sm-3\'>" +
                        "<img class=\'img-responsive\' src=\'" + item['thumbnail'] + "\'/>" +
                        "</div>" +
                        "<div class=\'col-sm-9\'>" +
                        item['title'] +
                        "</div>" +
                        "</div>" +
                        "</a>" +
                        "</div>";
                    if (i % 3 == 2)
                        html += "</div><br/><div class='row'>";
                }
                html += "</div>";
                var $tee = $(html);
                $suggestions.append($tee);
                $suggestions.find(".item").click(g);
                console.log(data);
                $b.removeAttr("disabled");
            });
        });
    })();
</script>
<?php $engine->stopInline() ?>


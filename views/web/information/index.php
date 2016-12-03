<?php
use app\components\Utils;

?>
<!--热点切换-->
<script src="/static/web/js/hot.js"></script>
<script>
    $(function () {
        $(".rslides").responsiveSlides({
            auto: true,
            pager: true,
            nav: true,
            speed: 500,
            namespace: "slide"
        });
    });
</script>
<div class="bg1 hot-con">
    <div class="con hiden">
        <div class="hot-slide fl">
            <ul class="rslides">
                <?php foreach ($left_img_list as $item): ?>
                    <li><a href="/web/information/detail/?id=<?= $item->id ?>"><img title="<?= $item->title ?>"
                                                                                    src="<?= $item->img_url ?>"></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="hot-news fl">
            <a href="<?php if (!empty($news_4)) echo '/web/information/detail/?id=' . $news_4->id; else echo '#'; ?>">
                <div class="hover-img"><img title="<?= Utils::getValue($news_4, 'title', ''); ?>"
                                            src="<?= Utils::getValue($news_4, 'img_url', ''); ?>"></div>
            </a>
        </div>
        <div class="hot-news fl mt10">
            <a href="<?php if (!empty($news_5)) echo '/web/information/detail/?id=' . $news_5->id; else echo '#'; ?>">
                <div class="hover-img"><img title="<?= Utils::getValue($news_5, 'title', ''); ?>"
                                            src="<?= Utils::getValue($news_5, 'img_url', ''); ?>"></div>
            </a>
        </div>
        <div class="list-sort clear pt20">
            <a tag="0" href="/web/information/">全部文章</a>
            <?php foreach ($class_list as $item): ?>
                <a tag="<?= $item->id ?>" href="/web/information/?class_id=<?= $item->id ?>"><?= $item->value ?></a>
            <?php endforeach; ?>
        </div>
        <ul class="hot-news-list">
            <?php foreach ($news_list as $item): ?>
                <li>
                    <a href="/web/information/detail/?id=<?= $item->id ?>"><img src="<?= $item->img_url ?>" class="fl"></a>
                    <div class="fl">
                        <h3 class="s20"><a href="/web/information/detail/?id=<?= $item->id ?>"><?= $item->title ?></a>
                        </h3>
                        <p class="s16 c6"><?= $item->summary ?>...</p>
                        <span class="c9"><?= $item->class_name ?>
                            | <?= Utils::formatDateTime($item->c_t, 'Y-m-d H:i') ?></span>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php
        if (!empty($pages)) {
            echo '
        <div class="page" >
            <a href = "/web/information/?class_id=' . $class_id . '&page=' . $pages['pre'] . '" title = "上一页" class="page-prev" > 上一页</a >
            <a href = "/web/information/?class_id=' . $class_id . '&page=' . $pages['next'] . '" title = "下一页" class="page-next" > 下一页</a >
        </div > ';
        } ?>
    </div>
</div>
<script>
    var menu = 'information_menu';
    $(function () {
        $a_list = $('.list-sort').find('a');
        var class_id = <?= $class_id ?>;
        $a_list.each(function () {
            if ($(this).attr('tag') == class_id) {
                $(this).addClass('sort-this');
                $(this).siblings('a').removeClass('sort-this');
                return false;
            }
        })
    })
</script>
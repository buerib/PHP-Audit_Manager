<!DOCTYPE html>
<html class="" lang="en">
<head  >

    <? require_once VIEW_PATH.'gitlab/common/header/include.php';?>
    <script src="<?=ROOT_URL?>dev/lib/url_param.js?v=<?=$_version?>" type="text/javascript" charset="utf-8"></script>
    <script src="<?=ROOT_URL?>dev/lib/handlebars-v4.0.10.js" type="text/javascript" charset="utf-8"></script>
    <script src="<?=ROOT_URL?>dev/js/handlebars.helper.js?v=<?=$_version?>" type="text/javascript" charset="utf-8"></script>
    <script src="<?=ROOT_URL?>dev/js/project/version.js?v=<?=$_version?>" type="text/javascript" charset="utf-8"></script>
    <script src="<?=ROOT_URL?>dev/lib/bootstrap-paginator/src/bootstrap-paginator.js?v=<?= $_version ?>"  type="text/javascript"></script>
</head>
<body class="" data-group="" data-page="projects:issues:index" data-project="xphp">
<? require_once VIEW_PATH.'gitlab/common/body/script.php';?>

<section class="has-sidebar page-layout max-sidebar">
    <? require_once VIEW_PATH . 'gitlab/common/body/page-left.php'; ?>

    <div class="page-layout page-content-body">
<? require_once VIEW_PATH.'gitlab/common/body/header-content.php';?>

<script>
    var findFileURL = "";
</script>
<div class="page-with-sidebar">
    <? require_once VIEW_PATH.'gitlab/project/common-page-nav-project.php';?>
    <? require_once VIEW_PATH.'gitlab/project/common-home-nav-links-sub-nav.php';?>

    <div class="content-wrapper page-with-layout-nav page-with-sub-nav">
        <div class="alert-wrapper">

            <div class="flash-container flash-container-page">
            </div>

        </div>
        <div class="container-fluid ">
            <div class="content" id="content-body">

                <div class="row prepend-top-default">
                    <div class="col-lg-3 settings-sidebar">
                        <h4 class="prepend-top-0">
                            版本列表
                        </h4>
                        <p>
                            使用版本号来管理项目的发布
                        </p>
                    </div>
                    <div class="col-lg-9">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <strong>版本</strong>
                                <div class="input-group member-search-form">
                                    <input type="search" name="search" id="search_input" placeholder="搜索版本" class="form-control" value="">
                                </div>
                            </div>
                            <ul class="flex-list content-list" id="list_render_id">


                            </ul>
                        </div>
                        <div class="gl-pagination" id="ampagination-bootstrap">

                        </div>


                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

    </div>
</section>

<script type="text/html"  id="list_tpl">
    {{#versions}}
    <li class="flex-row" id="li_data_id_{{id}}">
        <div class="row-main-content str-truncated">
            <a href="/ismond/xphp/tags/v1.2">
                <span class="item-title">
                    <i class="fa fa-tag"></i> {{name}}
                </span>
            </a>
            <div class="block-truncated">
                <div class="branch-commit">
                    <div class="icon-container commit-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 36 18" enable-background="new 0 0 36 18">
                            <path d="m34 7h-7.2c-.9-4-4.5-7-8.8-7s-7.9 3-8.8 7h-7.2c-1.1 0-2 .9-2 2 0 1.1.9 2 2 2h7.2c.9 4 4.5 7 8.8 7s7.9-3 8.8-7h7.2c1.1 0 2-.9 2-2 0-1.1-.9-2-2-2m-16 7c-2.8 0-5-2.2-5-5s2.2-5 5-5 5 2.2 5 5-2.2 5-5 5"></path>
                        </svg>

                    </div>
                    <small class="edited-text">
                        {{#if_eq released 1}}  已发布   {{else}}  未发布   {{/if_eq}}
                        ·
                        开始 {{start_date}} | 发布 {{release_date}}
                        .
                        {{#if description}}
                        <span>{{description}}</span>
                        {{else}}
                        <span>无描述</span>
                        {{/if}}
                    </small>

                </div>

            </div>
        </div>
        <div class="row-fixed-content controls">

        </div>
    </li>
    {{/versions}}
</script>

<script>
    let query_str = '<?=$query_str?>';
    let urls = parseURL(window.location.href);


    $(function() {

        let options = {
            query_str: window.query_str,
            query_param_obj: urls.searchObject,
            list_render_id:"list_render_id",
            list_tpl_id:"list_tpl",
            filter_url:"<?=ROOT_URL?>project/version/filter_search?project_id=<?=$project_id?>"
        };
        window.$versions = new Version( options );
        window.$versions.fetchAll();

        $('#search_input').bind('keyup', function(event) {
            if (event.keyCode == "13") {
                window.$versions.fetchAll(this.value);
            }
        });

    });

</script>
</body>
</html>

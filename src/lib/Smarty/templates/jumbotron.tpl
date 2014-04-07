{extends file="index.tpl"}
{block name=top_menu}
            <div class="container">
{$top_menu}
            </div>
{/block}
{block name=main_content}
        <div class="jumbotron">
            <div class="container">
{$jumbotron}
            </div>
        </div>

        <div class="container">
            <div class="row">
{$content}
            </div>
{include file="footer.tpl"}
        </div>
{/block}
<!--{include file="`$smarty.const.TEMPLATE_ADMIN_REALDIR`admin_popup_header.tpl"}-->
<script type="text/javascript">
</script>

<h2><!--{$tpl_subtitle}--></h2>
<form name="form1" id="form1" method="post" action="<!--{$smarty.server.REQUEST_URI|h}-->">
<input type="hidden" name="<!--{$smarty.const.TRANSACTION_ID_NAME}-->" value="<!--{$transactionid}-->" />
<input type="hidden" name="mode" value="edit">
<p>Settings<br/>
    <br/>
</p>

<table border="0" cellspacing="1" cellpadding="8" summary="Test">
    <tr>
        <td bgcolor="#f3f3f3">Sample Plug-in product message</td>
        <td><span class="attention"><!--{$arrErr.sampletext}--></span>
        <input type="text" name="sampletext" value="<!--{$arrForm.sampletext|h}-->" /><br/>
        </td>
    </tr>
   
</table>

<div class="btn-area">
    <ul>
        <li>
            <a class="btn-action" href="javascript:;" onclick="document.form1.submit();return false;"><span class="btn-next">Save and close</span></a>
        </li>
    </ul>
</div>

</form>
<!--{include file="`$smarty.const.TEMPLATE_ADMIN_REALDIR`admin_popup_footer.tpl"}-->

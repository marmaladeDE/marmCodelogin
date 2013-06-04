[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign}]

[{ if $readonly }]
[{assign var="readonly" value="readonly disabled"}]
[{else}]
[{assign var="readonly" value=""}]
[{/if}]

<form name="transfer" id="transfer" action="[{ $oViewConf->getSelfLink() }]" method="post">
    [{ $oViewConf->getHiddenSid() }]
    <input type="hidden" name="oxid" value="[{ $oxid }]">
    <input type="hidden" name="cl" value="marm_codelogin">
	<input type="hidden" name="language" value="[{ $actlang }]">
</form>

<form name="myedit" id="myedit" action="[{ $oViewConf->getSelfLink() }]" method="post">
	[{ $oViewConf->getHiddenSid() }]
    <input type="hidden" name="cl" value="marm_codelogin">
    <input type="hidden" name="fnc" value="">
	<input type="hidden" name="oxid" value="[{ $oxid }]">
	<input type="hidden" name="editval[oxuser__oxid]" value="[{ $oxid }]">

    <input type="hidden" name="language" value="[{ $actlang }]">
	<table>
		<tr>
			<td class="edittext">
				[{ oxmultilang ident="MARM_CODELOGIN_CODE"}]
			</td>
			<td class="edittext">
			[{if $gen_done}]
				<input type="text" class="editinput" size="25" maxlength="[{$edit->oxuser__marmcodelogin->fldmax_length}]" name="editval[oxuser__marmcodelogin]" value="[{$logincode}]" [{ $readonly }]>
			[{else}]
				<input type="text" class="editinput" size="25" maxlength="[{$edit->oxuser__marmcodelogin->fldmax_length}]" name="editval[oxuser__marmcodelogin]" value="[{$edit->oxuser__marmcodelogin->value}]" [{ $readonly }]>
			[{/if}]	
			</td>
			<td>
				<input type="submit" class="edittext" name="generate" value="[{ oxmultilang ident="MARM_CODELOGIN_GENERATE" }]" onclick="javascript:document.myedit.fnc.value='generateCode'"" [{ $readonly }]>
			</td>
		</tr>
		<tr>
            <td class="edittext">
            </td>
            <td class="edittext"><br>
				<input type="submit" class="edittext" name="save" value="[{ oxmultilang ident="GENERAL_SAVE" }]" onClick="Javascript:document.myedit.fnc.value='save'"" [{ $readonly }]>
            </td>
        </tr>
	</table>
</form>

[{include file="bottomnaviitem.tpl"}]
[{include file="bottomitem.tpl"}]
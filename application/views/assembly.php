<script type="text/javascript" src="/assets/js/assemble.js"></script>
<div class="leftPanel">
<br/>
Assemble a Bot<br/><br/>
<table id="assemble">
    <tr><td><div id="headSlot" class="assembleSlot" ondrop="drop(event)" ondragover="allowDrop(event)" data-slot="head">Head</div></td></tr>
    <tr><td></td></tr>
    <tr><td><div id="bodySlot" class="assembleSlot" ondrop="drop(event)" ondragover="allowDrop(event)" data-slot="body">Body</div></td></tr>
    <tr><td></td></tr>
    <tr><td><div id="feetSlot" class="assembleSlot" ondrop="drop(event)" ondragover="allowDrop(event)" data-slot="feet">Feet</div></td></tr>
</table>
<br/>
<input id="assembleBtn" type="button" value="Assemble" onclick="assembleClick()" disabled />
</div>
<br/>
{assemble_pieces}

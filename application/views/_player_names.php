<select id="playerNamesSelect" onchange="selectPlayer()">
{player_names}
<option value="{name}">{name}</option>
{/player_names}
</select>
<script type="text/javascript">
var select = document.getElementById("playerNamesSelect");
var found = false;
for (var i = 0; i < select.options.length; i++) {
    var opt = select.options[i];
    if (opt.value == "{player_name_selected}") {
        opt.setAttribute("selected", "selected");
        found = true;
    }
}
function selectPlayer() {
    var name = document.getElementById("playerNamesSelect").value;
    
    var href = "/portfolio";
    if (name != "")
        href += "/select/" + name;
        
    window.location = href;
}
if (!found)
{
    select.options[0].setAttribute("selected", "selected");
    selectPlayer();
}
</script>
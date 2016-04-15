
var dragObj; // Closure variable to conveniently track which DOM object is currently being dragged

/*
** Triggered when a bot piece enters the 'drag' state.
*/
function drag(e) {
    // Remember what object this is
    dragObj = e.target;
}

/*
** Triggered when a bot piece hovers over one of the possible bot piece slots.
** Must preventDefault() if we want the piece to be droppable there.
*/
function allowDrop(e) {
    // We check the 'data-slot' attributes to see if this is the right slot for the dragged piece
    if (dragObj.dataset.slot == e.target.dataset.slot)
        e.preventDefault();
}

function drop(e) {
    e.preventDefault();
	var target = e.target;
    
    // Remove any existing child nodes for our target
    while (target.hasChildNodes())
        target.removeChild(target.lastChild);
	
    target.style.backgroundImage = "url(" + dragObj.src + ")";
    target.style.height = "42px"; // The image won't appear unless we do this...
    
    target.dataset.piece = dragObj.src.match(/[abc][-]\d/);
    
    // Check if we have all slots filled
    checkSlots();
}

function checkSlots() {
    var head = $("#headSlot").get(0);
    var body = $("#bodySlot").get(0);
    var feet = $("#feetSlot").get(0);
    
    if (head.dataset.piece == null || body.dataset.piece == null || feet.dataset.piece == null)
        return;
    
    var btn = $("#assembleBtn").get(0);
    btn.disabled = null;
}

function assembleClick() {
    var head = $("#headSlot").get(0);
    var body = $("#bodySlot").get(0);
    var feet = $("#feetSlot").get(0);
    
    window.location = "assembly/pieces/" + head.dataset.piece +
        "/" + body.dataset.piece + "/" + feet.dataset.piece;
}

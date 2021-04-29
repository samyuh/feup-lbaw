// Disable submit on enter
window.addEventListener( "keydown", function (e) { if ( e.keyIdentifier == "U+000A" || e.keyIdentifier == "Enter" || e.keyCode == 13) { if (e.target.nodeName == "INPUT" && e.target.type == "text") { e.preventDefault(); return false; } } }, true);

// init toast
var toastElListTag = [].slice.call(document.querySelectorAll('.toast'));
let toastBodyTag = document.querySelector('.toast-body');
var toastListTag = toastElListTag.map(function (toastEl) {
  return new bootstrap.Toast(toastEl);
});


var tagsClean = [];
if (typeof tags !== 'undefined'){
    for (let i = 0; i < tags.length; i++) {
        tagsClean.push(tags[i].name);
    }
}

let tagsList = [];
const tagContainer = document.querySelector(".tag-container");
const tagInput = document.querySelector("#questionTagsSelect");

populateOldTags();
selectTag();



function selectTag() {
    if (tagInput != null && tagContainer != null) {
        // Case the tag is selected using the keyboard.
        tagInput.addEventListener("keyup", (e) => {
            if (e.key === "Enter")
                processTag();
            // Case the tag is selected using the mouse.
            let suggestionList = document.getElementById(
                "questionTagsSelectautocomplete-list"
            );
            if (suggestionList !== null) {
                suggestionList.addEventListener("click", () => processTag());
            }
        });
    }
}

function processTag() {
    tagInput.value.split(",").forEach((tag) => {
        if (tag != "" && tagsClean.includes(tag) && tagsList.length <= 4 && !tagsList.includes(tag)) {
            tagsList.push(tag);
        } else if (tag != "" && tagsList.includes(tag)){
            toastBodyTag.innerText = "Tag already included.";
            toastListTag[0].show();
        }
        else if (tag != "") {
            toastBodyTag.innerText = "Number of tags must be less than 5.";
            toastListTag[0].show();
        }
    });

    addTags();
    tagInput.value = "";
}

function populateOldTags() {
    if (typeof oldTagsList !== "undefined") {
        oldTagsList.forEach((tag) => {
            tagsList.push(tag["name"]);
        });
        addTags();
    }
}

/**
 * Creates the card of a tag for the given label.
 * @param {String} label - name of the tag.
 * @returns
 */
function createTags(label) {
    let id;
    for (let i = 0; i < tags.length; i++) {
        if (tags[i].name == label) id = tags[i].id;
    }

    const div = document.createElement("div");
    div.setAttribute(
        "class",
        "tag card rounded-1 manage-tag-card px-3 py-2 mx-1"
    );
    const innerDiv = document.createElement("div");
    innerDiv.setAttribute("class", "card-body d-flex p-0");

    const span = document.createElement("span");
    span.innerHTML = label;

    const hiddenV = document.createElement("input");
    hiddenV.setAttribute("name", "tagList[]");
    hiddenV.setAttribute("value", id);
    hiddenV.readOnly = true;
    hiddenV.hidden = true;

    const closeIcon = document.createElement("span");
    closeIcon.setAttribute("class", "icon-hover");
    closeIcon.setAttribute("title", "Delete");

    closeIcon.addEventListener("click", function (e) {
        clearTags();
        const tagLabel = e.target.getAttribute("data-item");
        const index = tagsList.indexOf(tagLabel);
        tagsList = [...tagsList.slice(0, index), ...tagsList.slice(index + 1)];
        addTags();
    });

    const buttonOne = document.createElement("button");
    buttonOne.setAttribute("class", "p-0");
    const iOne = document.createElement("i");
    iOne.setAttribute("class", "far fa-trash-alt");

    const buttonTwo = document.createElement("button");
    buttonTwo.setAttribute("class", "p-0");
    const iTwo = document.createElement("i");
    iTwo.setAttribute("class", "fas fa-trash-alt");
    iTwo.setAttribute("data-item", label);

    div.appendChild(innerDiv);
    div.appendChild(hiddenV);
    innerDiv.appendChild(span);
    innerDiv.appendChild(closeIcon);

    closeIcon.appendChild(buttonOne);
    closeIcon.appendChild(buttonTwo);
    buttonOne.appendChild(iOne);
    buttonTwo.appendChild(iTwo);

    return div;
}

function clearTags() {
    document.querySelectorAll("div .tag").forEach((tag) => {
        tag.parentElement.removeChild(tag);
    });
}

function addTags() {
    clearTags();
    tagsList
        .slice()
        .reverse()
        .forEach((tag) => {
            tagContainer.prepend(createTags(tag));
        });
}
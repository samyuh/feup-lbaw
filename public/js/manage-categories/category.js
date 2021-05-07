import {getToken, sendAjaxGetRequest, sendDataAjaxRequest} from "../common.js";


/**
 * This function treats DELETE and POST methods for categories.
 * @param responseJson received a json response.
 */
export function handleCategoryResponse(responseJson) {
    if (responseJson.hasOwnProperty('error')) {
        console.log(responseJson['success'], 'error');
        return;
    } else {
        console.log(responseJson['success'], 'success');
    }
    console.log(responseJson['url'])
    changeCategoryPage(responseJson['url']);
    listenPageCategory(responseJson['url']);
    listenDeleteCategory(responseJson['url']);
}

/**
 * This function treats GET methods for the categories.
 */
export function handleCategoryGet() {
    const response = JSON.parse(this.responseText);
    document.querySelector('#category-table').innerHTML = response.html;
    listenPageCategory(response.url);
    listenDeleteCategory(response.url);
}


/**
 * This function handles the search event for categories.
 * @param url {String} url of the category page.
 * @param searchDiv {String} Search div element.
 */
export function listenSearchCategory(url, searchDiv) {
    const searchInput = searchDiv.querySelector("input");
    searchInput.addEventListener("keyup", () => {
       sendSearch(url);
    });
}


/**
 * Listens for the delete button.
 * @param url{String} Url page where this request must happen.
 */
export function listenDeleteCategory(url) {
    const deleteButtons = document.querySelectorAll('.icon-hover');

    // TODO: change to support tag and course.
    deleteButtons.forEach(element => element.addEventListener("click", (event) => {
        console.log(event.target);
            sendDataAjaxRequest("delete", "/api"+url+"/delete", {
                input: getCategoryName(event.target),
            }, getToken(), handleCategoryResponse);
            listenPageCategory();
        }
        )
    );
}

export function listenPageCategory(url) {
    let pagination = document.querySelectorAll('.pagination a');
    if (pagination) {
        pagination.forEach(paginationLink => {
            paginationLink.addEventListener('click', function(event){changeCategoryPage.apply(this, [url, event])});
        });
    }
}

function changeCategoryPage(url, event) {
    if (event !== undefined && event !== null)
        event.preventDefault();

    const searchInput = getSearchInput();
    let page = window.location.href.split('page=')[1];
    if (this !== undefined && this !== null)
        page = this.href.split("page=")[1];

    const data = {'search-name': searchInput.value, 'page': page};

    sendAjaxGetRequest("/api" + url,
        data, handleCategoryGet);
    window.history.pushState({}, '', url + "?" + encodeForAjax(data));
}

/**
 * Send a search query.
 * @param url{String} Url page where this request must happen.
 */
export function sendSearch(url){
    const searchInputValue = getSearchInput().value;
    sendAjaxGetRequest("/api" + url, {"search-name": searchInputValue}, handleCategoryGet)
    window.history.pushState({}, '', url + "?" + encodeForAjax({"search-name": searchInputValue}))
}


export function getCategoryName(deleteButton) {
    const categoryRow = deleteButton.parentElement.parentElement.parentElement;
    return categoryRow.querySelector('td').innerText;
}

function getSearchInput() {
    let tagInputDiv = document.getElementById("input-category");
    let searchDiv = tagInputDiv.querySelectorAll("div")[1];
    return searchDiv.querySelector("input");
}

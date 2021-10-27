
/**
 * Sorts an HTML table
 * @param {HTMLTableElement} table The table to sort
 * @param {number} column The index of the column to sort
 * @param {boolean} asc Determines the order of sorting
 */
function sortTableByColumn(table, column, asc = true){
    const dirModifier = asc ? 1 : -1;
    const tBody = table.tBodies[0];
    const rows = Array.from(tBody.querySelectorAll("tr"));
    
    // Query the headers
    const headers = table.querySelectorAll('th');
    const type = headers[column].getAttribute('data-type');


    //Sort each row
    const sortedRows = rows.sort((a, b) => {
        //const aColText =a.querySelector(`td:nth-child(${ column + 1 })`).textContent.trim();
        const aColText = transform(headers, column, a.querySelector(`td:nth-child(${ column + 1 })`).textContent.trim());
        const bColText = transform(headers, column, b.querySelector(`td:nth-child(${ column + 1 })`).textContent.trim());

        //const bColText =b.querySelector(`td:nth-child(${ column + 1 })`).textContent.trim();

        return aColText > bColText ? (1 * dirModifier) : (-1 * dirModifier);
    });

    //Emptying the table
    while(tBody.firstChild) {
        tBody.removeChild(tBody.firstChild);
    }

    //Repopulate table with sorted rows
    tBody.append(...sortedRows);

    //Remember how the collumn is currently sorted
    table.querySelectorAll("th").forEach(th => th.classList.remove("th-sort-asc", "th-sort-desc"));
    table.querySelector(`th:nth-child(${ column + 1 })`).classList.toggle("th-sort-asc", asc);
    table.querySelector(`th:nth-child(${ column + 1 })`).classList.toggle("th-sort-desc", !asc);
}

// Transform the content of given cell in given column
    const transform = function (headers,index, content) {
        // Get the data type of column
        const type = headers[index].getAttribute('data-type');
        switch (type) {
            case 'number':
                return parseFloat(content);
            case 'string':
            default:
                return content;
        }
    };

document.querySelectorAll(".table-sortable th").forEach(headerCell => {
    headerCell.addEventListener("click", () =>{
        const tableElement = headerCell.parentElement.parentElement.parentElement;
        const headerIndex = Array.prototype.indexOf.call(headerCell.parentElement.children, headerCell);
        const currentIsAscending = headerCell.classList.contains("th-sort-asc");

        sortTableByColumn(tableElement, headerIndex, !currentIsAscending);
    });
});
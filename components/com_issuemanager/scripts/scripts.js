/*
    Document   : scripts.js
    Created on : 30-dic-2009, 19:30:05
    Author     : Luis Martín
    Description:
        Javascript functions for Issue Manager
*/

/**
 * validates form of text input
 */
function validate_form() {
    if (check_fields() && check_textarea()) {
        return true;
    } else return false;
}

/**
 * validates input text field called 'ticket_subject'
 */
function check_fields() {
    var textInput = document.getElementById("ticket_subject");
    // Regular expression to filter values
    var reg_exp = /[\w\W]+/i;
    if (textInput.type == "text" && !reg_exp.test(textInput.value)) {
        alert('Please fill in all the fields');
        return false;
    }
    return true;
}

/**
 * validates text area for message
 */
function check_textarea() {
    var textArea = document.getElementById("post_body");
    if (textArea.value.length < 10) {
        alert('The message body requires 10 characters at least');
        return false;
    } else return true;
}

/**
 * Sets or unsets the selected ticket id in the url of the link tag called "show_ticket"
 */
function setChecked(isChecked, value) {
    // Get reference to "show_ticket" <a> tag in module
    var showTicket = document.getElementById('show_ticket');
    var href = showTicket.attributes.getNamedItem('href').value;
    var parts = href.split('cid[0]=');
    if (isChecked) {
        showTicket.setAttribute('href', parts[0] + 'cid[0]=' + value);
    } else {
        showTicket.setAttribute('href', parts[0] + 'cid[0]=');
    }
}

/**
 * Checks whether the checkbox for 'select/unselect all rows' is selected. If deselected, all checkboxes will be deselected too,
 * so in this case the ticket id is deleted from the url of the link tag called "show_ticket"
 */
function setCheckedAll(isChecked) {
    var showTicket = document.getElementById('show_ticket');
    if (!isChecked) {
        var href = showTicket.attributes.getNamedItem('href').value;
        var parts = href.split('cid[0]=');
        showTicket.setAttribute('href', parts[0] + 'cid[0]=');
    }
}

/**
 * Builds URL for specified link so that if parameter ticketid is null, it means that more than one ticket must be changed at a time.
 * In this case an array containing their id's will be built and added to the url.
 * If ticketid has a value, this value will correspond to the only ticket whose status must be changed, and it will be added to the url
 */
function mark_resolution(link, ticketid) {
    var href = link.attributes.getNamedItem('href').value;
    var cid = "";
    if (ticketid == null) {
        var id_list = new Array();
        var numRows = document.getElementById('num_rows').value;
        for (var i=0; i < numRows; i++) {
            // Get reference to current checkbox
            var cb = document.getElementById('cb' + i);
            if (cb.checked) {
                id_list.push(cb.value);
            }
        }
        // Restaurar el array de id's de tickets en el atributo href del enlace especificado
        for (i=0; i < id_list.length; i++) {
            cid += '&cid[]=' + id_list[i];
        }
        link.setAttribute('href', href + cid);
    } else {
        cid = '&cid[]=' + ticketid;
        link.setAttribute('href', href + cid);
    }
}

var request = false;

function displayAjax(url) {
    request = false;
    // Safari, Firefox, Opera, IE7+, etc
    if (window.XMLHttpRequest) {
        request = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        // IE6-
        try {
            request = new ActiveXObject('Msxml2.XMLHTTP');
        } catch(e) {
            try {
                request = new ActiveXObject('Microsoft.XMLHTTP');
            } catch (e) {}
        }
    }
    // Check whether valid request object created
    if (!request) {
        overlib('Error: Cannot create XMLHTTP object');
        return false;
    }
    // Event handler for reception
    request.onreadystatechange = displayResult;
    // Assign url and method
    request.open('GET', url, true);
    // Send AJAX request
    request.send(null);
}

function displayResult() {
    // Check whether result has been received correctly (estado = 4)
    if (request.readyState == 4) {
        // Check status code
        if (request.status == 200) {
            overlib(request.responseText, CAPTION, 'Info', BELOW, RIGHT);
        } else {
            overlib('There was a problem with the request.', CAPTION, 'Retrieval Error: ' + request.status, BELOW, RIGHT);
        }
    }
}

function abortAjax() {
	request.abort();
}
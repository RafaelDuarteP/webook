var selectedRow = null;
function onFormSubmit(e){
    event.preventDefault();
    var formData = readFormData();
    if(selectedRow === null){
        insertNewRecord(formData);
    }else{
        updateRecord(formData)
    }
    resetForm();
    }
// Read operation using this function
function readFormData(){
    var formData = {};
    formData["livro"] = document.getElementById("livro").value;
    formData["autor"] = document.getElementById("autor").value;
    formData["idioma"] = document.getElementById("idioma").value;
    formData["genero"] = document.getElementById("genero").value;
    formData["isbn"] = document.getElementById("isbn").value;
    formData["ano"] = document.getElementById("ano").value;
    formData["edicao"] = document.getElementById("edicao").value;
    formData["paginas"] = document.getElementById("paginas").value;
    formData["editora"] = document.getElementById("editora").value;
    return formData;
}

// Create operation
function insertNewRecord(data){
    var table = document.getElementById("bookList").getElementsByTagName('tbody')[0];
    var newRow = table.insertRow(table.length);
    var cell1 = newRow.insertCell(0);
        cell1.innerHTML = data.livro;
    var cell2 = newRow.insertCell(1);
        cell2.innerHTML = data.autor;
    var cell3 = newRow.insertCell(2);
        cell3.innerHTML = data.idioma;
    var cell4 = newRow.insertCell(3);
        cell4.innerHTML = data.genero;
    var cell5 = newRow.insertCell(4);
        cell5.innerHTML = data.isbn;
    var cell6 = newRow.insertCell(5);
        cell6.innerHTML = data.ano;
    var cell7 = newRow.insertCell(6);
        cell7.innerHTML = data.edicao;
    var cell8 = newRow.insertCell(7);
        cell8.innerHTML = data.paginas;
    var cell9 = newRow.insertCell(8);
        cell9.innerHTML = data.editora;
    var cell10 = newRow.insertCell(9);
        cell10.innerHTML = `<a href="#" onClick='onEdit(this)'>Edit</a>
                        <a href="#" onClick='onDelete(this)'>Delete</a>`;
}

// To Reset the data of fill input
function resetForm(){
    document.getElementById('livro').value = '';
    document.getElementById('autor').value = '';
    document.getElementById('idioma').value = '';
    document.getElementById('genero').value = '';
    document.getElementById('isbn').value = '';
    document.getElementById('ano').value = '';
    document.getElementById('edicao').value = '';
    document.getElementById('paginas').value = '';
    document.getElementById('editora').value = '';
    selectedRow = null;
}

// For Edit operation
function onEdit(td){
    selectedRow = td.parentElement.parentElement;
    document.getElementById('livro').value = selectedRow.cells[0].innerHTML;
    document.getElementById('autor').value = selectedRow.cells[1].innerHTML;
    document.getElementById('idioma').value = selectedRow.cells[2].innerHTML;
    document.getElementById('genero').value = selectedRow.cells[3].innerHTML;
    document.getElementById('isbn').value = selectedRow.cells[4].innerHTML;
    document.getElementById('ano').value = selectedRow.cells[5].innerHTML;
    document.getElementById('edicao').value = selectedRow.cells[6].innerHTML;
    document.getElementById('paginas').value = selectedRow.cells[7].innerHTML;
    document.getElementById('editora').value = selectedRow.cells[8].innerHTML;
}
function updateRecord(formData){
    selectedRow.cells[0].innerHTML = formData.livro;
    selectedRow.cells[1].innerHTML = formData.autor;
    selectedRow.cells[2].innerHTML = formData.idioma;
    selectedRow.cells[3].innerHTML = formData.genero;
    selectedRow.cells[4].innerHTML = formData.isbn;
    selectedRow.cells[5].innerHTML = formData.ano;
    selectedRow.cells[6].innerHTML = formData.edicao;
    selectedRow.cells[7].innerHTML = formData.paginas;
    selectedRow.cells[8].innerHTML = formData.editora;
}
function onDelete(td){
    if(confirm('Are you sure you want to delete this record?')){
        row = td.parentElement.parentElement;
        document.getElementById('bookList').deleteRow(row.rowIndex);
        resetForm();
    }    
}
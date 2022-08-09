// show functions are for forms
function showPageHome(showForm, hideForm1, hideForm2, hideForm3, hideForm4){
    document.getElementById(hideForm1).style.display = "none";
    document.getElementById(hideForm2).style.display = "none";
    document.getElementById(hideForm3).style.display = "none";
    document.getElementById(hideForm4).style.display = "none";
    document.getElementById(showForm).style.display = "block";
}
// show functions in userPage
function showPage(showID,hideID_1,hideID_2){
    document.getElementById(hideID_1).style.display = "none";
    document.getElementById(hideID_2).style.display = "none";
    document.getElementById(showID).style.display = "block";
}
// show functions in adminPage
function showAdmin(showPage, hidePage1, hidePage2, hidePage3)
{
    document.getElementById(hidePage1).style.display = "none";
    document.getElementById(hidePage2).style.display = "none";
    document.getElementById(hidePage3).style.display = "none";
    document.getElementById(showPage).style.display = "block";
}



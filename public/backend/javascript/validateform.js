function validateForm() {
    let x = document.forms["myForm"]["fname"].value;
    if (x == "") {
      alert("Vui lòng nhập trường này!");
      return false;
    }
  }
function adjustNumber(event, button, value) {
  event.stopPropagation();

  const inputField = button.parentElement.querySelector("input");
  let currentValue = parseInt(inputField.value);
  currentValue += value;
  inputField.value = currentValue;

  const dropdownButton = document.getElementById("dropdownMenuButton1");
  const adultValue = document.getElementById("adult-input").value;
  const childValue = document.getElementById("child-input").value;
  const roomValue = document.getElementById("room-input").value;
  dropdownButton.textContent = `${adultValue} người lớn - ${childValue} trẻ em - ${roomValue} phòng`;
}

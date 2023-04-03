const backBtn = document.getElementById("go-back");

if (backBtn) {
  backBtn.addEventListener("click", () => {
    history.back();
  });
}
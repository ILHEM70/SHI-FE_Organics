document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".bouton_panier").forEach((button) => {
    button.addEventListener("click", function () {
      const id = parseInt(this.dataset.id);

      fetch(`/cart/add/`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({id:id}),
      })
        .then((response) => response.json())
        .then((data) => {
          const p = document.createElement('span');

          p.textContent = data.message;

          this.parentElement.appendChild(p);

          document.querySelector('#session_nb').textContent = data.nb;
          
        })
        .catch((error) => console.error("Erreur fetch :", error));
    });
  });
});

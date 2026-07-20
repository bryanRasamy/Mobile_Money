function openModal(id) {
  document.getElementById(id).classList.add('open');
}

function closeModal(id) {
  document.getElementById(id).classList.remove('open');
}

function closeModalOverlay(event) {
  if (event.target.classList.contains('modal-overlay')) {
    event.target.classList.remove('open');
  }
}

let compteurDestinataire = 1;

function ajouterLigneDestinataire() {
  const conteneur = document.getElementById('listeDestinataires');
  const ligne = document.createElement('div');
  ligne.className = 'destinataire-ligne flex gap-2 mb-2';
  ligne.innerHTML = `
    <input type="tel" name="destinataires[${compteurDestinataire}][telephone]" class="input-field" placeholder="Numero du beneficiaire" required>
    <input type="number" name="destinataires[${compteurDestinataire}][montant]" class="input-field" placeholder="Montant (Ar)" min="100" required>
    <button type="button" class="btn-icon" onclick="this.parentElement.remove()"><i class="fas fa-trash"></i></button>
  `;
  conteneur.appendChild(ligne);
  compteurDestinataire++;
}

function handleTransfer(event) {
  event.preventDefault();
  envoyerOperation(event.target, 'modalTransfer');
}

function showToast(message, type = 'info') {
  const container = document.getElementById('toastContainer');
  const toast = document.createElement('div');
  toast.className = `toast toast-${type}`;
  toast.textContent = message;
  container.appendChild(toast);
  setTimeout(() => toast.remove(), 4000);
}

async function envoyerOperation(form, modalId) {
  try {
    const response = await fetch(form.action, {
      method: 'POST',
      headers: { 'X-Requested-With': 'XMLHttpRequest' },
      body: new FormData(form),
    });
    const data = await response.json();

    if (data.csrf_hash) {
      document.querySelectorAll('.csrf-input').forEach(input => {
        input.value = data.csrf_hash;
      });
    }

    showToast(data.message, data.success ? 'success' : 'error');

    if (data.success) {
      closeModal(modalId);
      setTimeout(() => window.location.reload(), 800);
    }
  } catch (error) {
    showToast('Erreur réseau, veuillez réessayer.', 'error');
  }
}

function handleDepot(event) {
  event.preventDefault();
  envoyerOperation(event.target, 'modalDepot');
}

function handleRetrait(event) {
  event.preventDefault();
  envoyerOperation(event.target, 'modalRetrait');
}

function handleTransfer(event) {
  event.preventDefault();
  envoyerOperation(event.target, 'modalTransfer');
}

function logout() {
  window.location.href = '/logout';
}
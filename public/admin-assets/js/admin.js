/**
 * 99 BAKERY - ADMIN CMS DASHBOARD JAVASCRIPT
 * Handling interactive table filtering, live image upload previews, modals, search, and UI state
 */

document.addEventListener('DOMContentLoaded', function () {

  // 1. Live Table Search Filter
  const tableSearchInput = document.getElementById('tableSearchInput');
  if (tableSearchInput) {
    tableSearchInput.addEventListener('keyup', function () {
      const filterValue = this.value.toLowerCase().trim();
      const tableRows = document.querySelectorAll('.table-admin tbody tr');

      tableRows.forEach(row => {
        const textContent = row.textContent.toLowerCase();
        if (textContent.includes(filterValue)) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    });
  }

  // 2. Status / Category Filter Select
  const categoryFilterSelect = document.getElementById('categoryFilterSelect');
  if (categoryFilterSelect) {
    categoryFilterSelect.addEventListener('change', function () {
      const selectedCat = this.value.toLowerCase();
      const tableRows = document.querySelectorAll('.table-admin tbody tr');

      tableRows.forEach(row => {
        const rowCat = row.getAttribute('data-category') || '';
        if (selectedCat === 'all' || selectedCat === '' || rowCat.toLowerCase() === selectedCat) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    });
  }

  // 3. Live Image Upload Preview Handler
  // Any input with class "img-upload-input" will preview selected file inside matching "img-preview-target"
  const imageInputs = document.querySelectorAll('.img-upload-input');
  imageInputs.forEach(input => {
    input.addEventListener('change', function (e) {
      const file = e.target.files[0];
      const targetId = this.getAttribute('data-preview-target');
      const targetImg = targetId ? document.getElementById(targetId) : null;

      if (file && targetImg) {
        const reader = new FileReader();
        reader.onload = function (evt) {
          targetImg.src = evt.target.result;
          targetImg.style.display = 'block';
        };
        reader.readAsDataURL(file);
      }
    });
  });

  // 4. Action Simulation Notification for Buttons
  const actionButtons = document.querySelectorAll('.sim-action-btn');
  actionButtons.forEach(btn => {
    btn.addEventListener('click', function (e) {
      e.preventDefault();
      const actionName = this.getAttribute('data-action') || 'Tindakan';
      alert(`[Simulasi CMS] ${actionName} telah berhasil diproses!`);
    });
  });

});

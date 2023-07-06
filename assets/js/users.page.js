import { http } from './helpers/http.js';

const initUsersPage = () => {
  const deleteBtns = document.querySelectorAll('.delete-btn');
  
  const handleDelete = (e) => {
    const btn = e.target;
    const userRecord = btn.closest('tr');
    const id = btn.dataset.id;
    
    btn.disabled = true;
    
    http.delete(`/users/${id}`)
      .then(() => {
        userRecord.remove();
        btn.removeEventListener('click', handleDelete);
      })
      .finally(() => btn.removeAttribute('disabled'));
  }

  deleteBtns.forEach(btn => btn.addEventListener('click', handleDelete));
}

document.addEventListener('DOMContentLoaded', initUsersPage);
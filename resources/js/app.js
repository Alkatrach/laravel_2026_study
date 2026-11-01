import * as bootstrap from 'bootstrap'
import '@fortawesome/fontawesome-free/js/all.js';

const toastBtn = document.getElementById('liveToastBtn')//тост
toastBtn?.addEventListener('click', () => {
  bootstrap.Toast.getOrCreateInstance(document.getElementById('liveToast')).show()
})

document.querySelectorAll('[data-bs-toggle="popover"]').forEach((el) => {//поповер
  new bootstrap.Popover(el, { trigger: 'hover focus' })
})

const modals = [...document.querySelectorAll('.modal')]

document.addEventListener('keydown', (e) => {//стрелочки
  const i = modals.findIndex((m) => m.classList.contains('show'))
  if (i < 0 || !['ArrowLeft', 'ArrowRight'].includes(e.key)) return

  const step = e.key === 'ArrowRight' ? 1 : -1
  const next = modals[(i + step + modals.length) % modals.length]

  modals[i].addEventListener('hidden.bs.modal', () => bootstrap.Modal.getOrCreateInstance(next).show(), { once: true })
  bootstrap.Modal.getInstance(modals[i]).hide()
})
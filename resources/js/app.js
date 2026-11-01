import * as bootstrap from 'bootstrap'
import '@fortawesome/fontawesome-free/js/all.js'

const ajaxHeaders = { 'X-Requested-With': 'XMLHttpRequest' }

const toastBtn = document.getElementById('liveToastBtn')
toastBtn?.addEventListener('click', () => {
  bootstrap.Toast.getOrCreateInstance(document.getElementById('liveToast')).show()
})

const detailsModal = document.getElementById('turtleModal')
const formModal = document.getElementById('formModal')
let current = -1

const showButtons = () => [...document.querySelectorAll('.js-show')]

function initPopovers(root) {
  root.querySelectorAll('[data-bs-toggle="popover"]').forEach((el) => {
    new bootstrap.Popover(el, { trigger: 'hover focus' })
  })
}

async function load(url, modalEl) {
  const res = await fetch(url, { headers: ajaxHeaders })
  if (!res.ok) return
  document.querySelectorAll('.popover').forEach((p) => p.remove())
  modalEl.querySelector('.modal-content').innerHTML = await res.text()
  initPopovers(modalEl)
  bootstrap.Modal.getOrCreateInstance(modalEl).show()
}

document.addEventListener('click', (e) => {
  const show = e.target.closest('.js-show')
  if (show) {
    current = showButtons().indexOf(show)
    load(show.dataset.url, detailsModal)
    return
  }

  const form = e.target.closest('.js-form')
  if (form) load(form.dataset.url, formModal)
})

document.addEventListener('keydown', (e) => {
  if (!detailsModal.classList.contains('show') || !['ArrowLeft', 'ArrowRight'].includes(e.key)) return

  const list = showButtons()
  const step = e.key === 'ArrowRight' ? 1 : -1
  current = (current + step + list.length) % list.length
  load(list[current].dataset.url, detailsModal)
})

document.addEventListener('submit', async (e) => {
  const form = e.target.closest('.js-turtle-form')
  if (!form) return

  e.preventDefault()
  form.classList.add('was-validated')
  if (!form.checkValidity()) return
  form.classList.remove('was-validated')
  form.querySelectorAll('.is-invalid').forEach((el) => el.classList.remove('is-invalid'))

  const res = await fetch(form.action, {
    method: 'POST',
    body: new FormData(form),
    headers: { ...ajaxHeaders, Accept: 'application/json' },
  })

  if (res.ok) {
    location.reload()
    return
  }

  if (res.status === 422) {
    const { errors } = await res.json()
    Object.entries(errors).forEach(([name, messages]) => {
      const input = form.elements[name]
      if (!input) return
      input.classList.add('is-invalid')
      input.parentElement.querySelector('.invalid-feedback').textContent = messages[0]
    })
  }
})

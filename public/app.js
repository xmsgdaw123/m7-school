(() => {
  let loginStatus = location.pathname.includes('register')

  const breadcrumb = document.getElementById('breadcrumb')
  const containerHome = document.getElementById('home-container')
  const containerProfile = document.getElementById('profile-container')
  const navHome = document.getElementById('home')
  const navProfile = document.getElementById('profile')
  const inputEmail = document.getElementById('email')
  const inputName = document.getElementById('name')
  const inputSurname = document.getElementById('surname')
  const inputIsTeacher = document.getElementById('isTeacher')
  const inputPassword = document.getElementById('password')
  const btnAuth = document.getElementById('btn-auth')
  const btnSwitchLogin = document.getElementById('login-switch')
  const btnAddModule = document.getElementById('btn-add-module')
  const loginTitle = document.getElementById('login-title')
  const inputNewModuleCode = document.getElementById('new-module-code')
  const inputNewModuleName = document.getElementById('new-module-name')
  const inputNewModuleDescription = document.getElementById('new-module-description')

  btnAuth?.addEventListener('click', async evt => {
    evt.preventDefault()
    const email = inputEmail.value
    const password = inputPassword.value

    const body = new FormData()
    body.append('operation', loginStatus ? 'register' : 'login')
    body.append('email', email)
    body.append('password', password)

    if (loginStatus) {
      body.append('name', inputName.value)
      body.append('surname', inputSurname.value)
      body.append('isTeacher', inputIsTeacher.checked)
    }

    const request = await fetch('./controllers/auth.php', {
      method: 'POST',
      redirect: 'follow',
      body
    })

    if (request.redirected) {
      window.location.href = request.url
      return
    }

    const response = await request.json()
    if (response.status === 'error') {
      inputEmail.value = ''
      inputPassword.value = ''
      alert(response.data)
    }
  })

  btnAddModule?.addEventListener('click', async evt => {
    evt.preventDefault()
    const body = new FormData()
    body.append('code', inputNewModuleCode.value)
    body.append('name', inputNewModuleName.value)
    body.append('description', inputNewModuleDescription.value)

    const request = await fetch('../controllers/add-module.php', {
      method: 'POST',
      redirect: 'follow',
      body
    })

    if (request.redirected) {
      window.location.href = request.url
      return
    }

    const response = await request.json()
    if (response.status === 'error') alert(response.data)
  })
})()
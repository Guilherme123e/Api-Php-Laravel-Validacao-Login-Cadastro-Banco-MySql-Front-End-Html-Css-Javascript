const formLogin = document.getElementById('formulario_login');
const msg1 = document.getElementById('msg1');

formLogin.addEventListener('submit', async (e) => {
  e.preventDefault();
  msg1.innerHTML = '';

  const email = formLogin.email.value.trim();
  const senha = formLogin.senha.value;

  if (!email || !senha) {
    msg1.style.color = 'red';
    msg1.textContent = 'Por favor, preencha todos os campos.';
    return;
  }

  try {
    const token = formLogin.querySelector('input[name="_token"]')?.value || '';

    const response = await fetch('/login', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        ...(token && { 'X-CSRF-TOKEN': token })
      },
      body: JSON.stringify({ email, senha })
    });

    const res = await response.json();

    if (response.ok) {
      // ✅ Login bem-sucedido
      window.location.href = '/login-sucesso';
    } else {
      // ❌ Erro de autenticação
      msg1.style.color = 'red';
      msg1.textContent = res.message || 'Email ou senha inválidos.';
    }
  } catch (err) {
    msg1.style.color = 'red';
    msg1.textContent = 'Erro de conexão com o servidor.';
  }
});

const form = document.getElementById('formulario_cadastro');
const msg = document.getElementById('msg');

function validarCampos(data) {
  const errors = [];

  // nome: obrigatório, string, max 255
  if (!data.nome) {
    errors.push('O nome é obrigatório.');
  } else if (data.nome.length > 255) {
    errors.push('O nome deve ter no máximo 255 caracteres.');
  }

  // cpf: obrigatório, string, exatamente 11 dígitos (numéricos)
  if (!data.cpf) {
    errors.push('O CPF é obrigatório.');
  } else if (!/^\d{11}$/.test(data.cpf)) {
    errors.push('O CPF deve conter exatamente 11 números.');
  }

  // rg: obrigatório, string, entre 5 e 20 caracteres
  if (!data.rg) {
    errors.push('O RG é obrigatório.');
  } else if (data.rg.length < 5 || data.rg.length > 20) {
    errors.push('O RG deve ter entre 5 e 20 caracteres.');
  }

  // data_nascimento: obrigatório, formato YYYY-MM-DD, depois de 1990-01-01 e antes de hoje
  if (!data.data_nascimento) {
    errors.push('A data de nascimento é obrigatória.');
  } else {
    const nascimento = new Date(data.data_nascimento);
    const minDate = new Date('1990-01-01');
    const today = new Date();
    today.setHours(0, 0, 0, 0); // zerar hora

    if (isNaN(nascimento.getTime())) {
      errors.push('Data de nascimento inválida.');
    } else if (nascimento < minDate) {
      errors.push('A data de nascimento deve ser posterior a 01/01/1990.');
    } else if (nascimento >= today) {
      errors.push('A data de nascimento deve ser anterior a hoje.');
    }
  }

  // endereco: obrigatório, string, max 255
  if (!data.endereco) {
    errors.push('O endereço é obrigatório.');
  } else if (data.endereco.length > 255) {
    errors.push('O endereço deve ter no máximo 255 caracteres.');
  }

  // telefone: obrigatório, string, max 20 caracteres
  if (!data.telefone) {
    errors.push('O telefone é obrigatório.');
  } else if (data.telefone.length > 20) {
    errors.push('O telefone deve ter no máximo 20 caracteres.');
  }

  // email: obrigatório, formato email válido, email e confirmação iguais
  if (!data.email) {
    errors.push('O email é obrigatório.');
  } else if (!/\S+@\S+\.\S+/.test(data.email)) {
    errors.push('Email inválido.');
  }
  if (data.email !== data.email_confirmation) {
    errors.push('Email e confirmação de email não conferem.');
  }

  // senha: obrigatório, mínimo 6 caracteres, senha e confirmação iguais
  if (!data.senha) {
    errors.push('A senha é obrigatória.');
  } else if (data.senha.length < 6) {
    errors.push('A senha deve ter no mínimo 6 caracteres.');
  }
  if (data.senha !== data.senha_confirmation) {
    errors.push('Senha e confirmação de senha não conferem.');
  }

  // genero: obrigatório, deve ser um dos valores permitidos
  const generosValidos = ['masculino', 'feminino', 'outro'];
  if (!data.genero) {
    errors.push('O gênero é obrigatório.');
  } else if (!generosValidos.includes(data.genero)) {
    errors.push('Gênero inválido.');
  }

  return errors;
}

form.addEventListener('submit', async (e) => {
  e.preventDefault();
  msg.innerHTML = '';

  const data = {
    nome: form.nome.value.trim(),
    cpf: form.cpf.value.trim(),
    rg: form.rg.value.trim(),
    data_nascimento: form.data_nascimento.value,
    endereco: form.endereco.value.trim(),
    telefone: form.telefone.value.trim(),
    email: form.email.value.trim(),
    email_confirmation: form.email_confirmation.value.trim(),
    senha: form.senha.value,
    senha_confirmation: form.senha_confirmation.value,
    genero: form.genero.value,
  };

  const errors = validarCampos(data);

  if (errors.length > 0) {
    msg.style.color = 'red';
    msg.innerHTML = `<ul>${errors.map(e => `<li>${e}</li>`).join('')}</ul>`;
    return;
  }

  // Captura o token CSRF do input hidden
  const token = form.querySelector('input[name="_token"]').value;

  try {
    const response = await fetch('/register', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-CSRF-TOKEN': token,
      },
      body: JSON.stringify(data),
    });

    const res = await response.json();

    if (response.ok) {
      msg.style.color = 'green';
      msg.textContent = res.message || '✅ Cadastro realizado com sucesso!';
      form.reset();
      // Redireciona para a página /cadastro-sucesso após o cadastro
      window.location.href = '/cadastro-sucesso';
    } else {
      msg.style.color = 'red';

      if (res.errors) {
        // Se erro no cpf por duplicidade
        if (
          res.errors.cpf &&
          res.errors.cpf.some(e => e.toLowerCase().includes('unique'))
        ) {
          msg.textContent = '❌ Usuário já existente com este CPF.';
        } else {
          // Outros erros
          msg.innerHTML = `<ul>${Object.values(res.errors).flat().map(e => `<li>${e}</li>`).join('')}</ul>`;
        }
      } else {
        msg.textContent = res.message || '❌ Erro ao cadastrar.';
      }
    }
  } catch (error) {
    msg.style.color = 'red';
    msg.textContent = '❌ Erro de conexão com o servidor.';
  }
});

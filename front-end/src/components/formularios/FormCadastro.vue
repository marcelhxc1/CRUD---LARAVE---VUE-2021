<template>
<b-container class="bv-example-row">
  <b-row class="d-flex justify-content-center">
  <div class="justify-content-center w-50 shadow p-3 mb-5 bg-white rounded align-center">
    <b-form @submit="onSubmit" v-if="show">
      <b-form-group id="input-group-1" label="Seu E-mail:" label-for="input-1">
        <b-form-input
          id="input-1"
          v-model="email"
          type="email"
          placeholder="Preencha o E-mail"
          required
        ></b-form-input>
      </b-form-group>

      <b-form-group id="input-group-2" label="Seu Nome:" label-for="input-2">
        <b-form-input
          id="input-2"
          v-model="nome"
          placeholder="Preencha seu nome"
          required
          @keydown="NameValidation($event)"
        ></b-form-input>
      </b-form-group>

      <b-form-group
        id="input-group-2"
        label="Data de Nascimento:"
        label-for="input-2"
      >
        <b-form-input
          id="input-2"
          type="date"
          v-model="nascimento"
          placeholder="Preencha o nascimento"
          required
        ></b-form-input>
      </b-form-group>

      <b-form-group id="input-group-2" label="CPF:" label-for="input-2">
        <b-form-input
          id="input-2"
          v-model="cpf"
          placeholder="Preencha o CPF"
          required
          v-mask="'###.###.###-##'"
        ></b-form-input>
      </b-form-group>

      <b-button type="submit" variant="primary">Cadastrar</b-button>
    </b-form>
  </div>
  </b-row>
</b-container>
</template>

<script>
export default {
  data() {
    return {
      email: "",
      nome: "",
      nascimento: "",
      cpf: "",
      show: true,
    };
  },
  methods: {
    onSubmit(event) {
      const data = {
        nome: this.nome,
        email: this.email,
        cpf: this.cpf,
        nascimento: this.nascimento,
      };
      event.preventDefault();
      if (this.isValidCPF(this.cpf)) {
        this.axios
          .post("http://localhost:8000/api/registrar", data)
          .then(function (response) {
            alert(response.data.msg);
            event.target.reset();
          })
          .catch(function () {
            console.log("Erro ao salvar o usuário");
          });
      } else {
        alert("CPF inválido");
      }
    },
    isValidCPF(cpf) {
      if (typeof cpf !== "string") return false;
      cpf = cpf.replace(/[\s.-]*/gim, "");
      if (
        !cpf ||
        cpf.length != 11 ||
        cpf == "00000000000" ||
        cpf == "11111111111" ||
        cpf == "22222222222" ||
        cpf == "33333333333" ||
        cpf == "44444444444" ||
        cpf == "55555555555" ||
        cpf == "66666666666" ||
        cpf == "77777777777" ||
        cpf == "88888888888" ||
        cpf == "99999999999"
      ) {
        return false;
      }
      var soma = 0;
      var resto;
      for (var i = 1; i <= 9; i++)
        soma = soma + parseInt(cpf.substring(i - 1, i)) * (11 - i);
      resto = (soma * 10) % 11;
      if (resto == 10 || resto == 11) resto = 0;
      if (resto != parseInt(cpf.substring(9, 10))) return false;
      soma = 0;
      for (i = 1; i <= 10; i++)
        soma = soma + parseInt(cpf.substring(i - 1, i)) * (12 - i);
      resto = (soma * 10) % 11;
      if (resto == 10 || resto == 11) resto = 0;
      if (resto != parseInt(cpf.substring(10, 11))) return false;
      return true;
    },
    NameValidation(e) {
      if (!e.key.match(/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ'\s]+$/)) {
        e.preventDefault();
      }
    },
  },
};
</script>
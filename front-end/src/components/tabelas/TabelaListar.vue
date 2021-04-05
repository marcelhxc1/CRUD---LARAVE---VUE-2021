<template>
  <div class="container">
    <div>
      <b-row>
        <b-col>
          <b-form-input
            class="mb-3 mr-1"
            v-model="text"
            placeholder="Buscar"
          ></b-form-input>
        </b-col>
        <b-col md="2">
          <b-button @click="buscar(text)" pill variant="success"
            >Pesquisar</b-button
          ></b-col
        >
      </b-row>
    </div>
    <table v-if="listar" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Id</th>
          <th>Nome</th>
          <th>CPF</th>
          <th>E-mail</th>
          <th>Data de Nascimento</th>
          <th>Ação</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, i) in list" :key="item.id">
          <td>{{ i }}</td>
          <td>{{ item.nome }}</td>
          <td>{{ item.cpf }}</td>
          <td>{{ item.email }}</td>
          <td>{{ item.data_nascimento }}</td>
          <td>
            <b-button @click="modal(i)" variant="success">Editar</b-button>
            |
            <b-button @click="Remover(item.id)" variant="danger"
              >Excluir</b-button
            >
          </td>
        </tr>
      </tbody>
    </table>

    <table v-else class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Id</th>
          <th>Nome</th>
          <th>CPF</th>
          <th>E-mail</th>
          <th>Data de Nascimento</th>
          <th>Ação</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, i) in pesquisa" :key="item.id">
          <td>{{ i }}</td>
          <td>{{ item.nome }}</td>
          <td>{{ item.cpf }}</td>
          <td>{{ item.email }}</td>
          <td>{{ item.data_nascimento }}</td>
          <td>
            <b-button @click="modal(i)" variant="success">Editar</b-button>
            |
            <b-button @click="Remover(item.id)" variant="danger"
              >Excluir</b-button
            >
          </td>
        </tr>
      </tbody>
    </table>
    <b-modal v-model="modalShow">
      <b-form @submit.prevent v-if="show">
        <b-form-group
          id="input-group-1"
          label="Seu E-mail:"
          label-for="input-1"
        >
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
            type="text"
            v-model="nascimento"
            placeholder="Preencha o nascimento"
            required
            v-mask="'##/##/####'"
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
        <b-button type="submit" @click="editar(id)" variant="primary"
          >Cadastrar</b-button
        >
      </b-form>
    </b-modal>
  </div>
</template>

<script>
export default {
  data() {
    return {
      list: [],
      pesquisa: [],
      modalShow: false,
      show: true,
      email: "",
      nome: "",
      nascimento: "",
      cpf: "",
      id: 0,
      text: "",
      listar: true,
    };
  },
  mounted() {
    this.onLoad();
  },
  methods: {
    onLoad() {
      let self = this;
      this.axios
        .get("http://localhost:8000/api/listar")
        .then(function (response) {
          var list = [];
          response.data.result.map(function (value, key) {
            list.push(value);
            (self.list = list), key;
          });
        })
        .catch(function () {
          console.log("Erro ao obter o usuário");
        });
    },
    modal(item) {
      (this.modalShow = true),
        (this.email = this.list[item].email),
        (this.nome = this.list[item].nome),
        (this.nascimento = this.list[item].data_nascimento),
        (this.cpf = this.list[item].cpf);
      this.id = this.list[item].id;
    },
    Remover(item) {
      let self = this;
      var data = [
        {
          id: item,
        },
      ];
      this.axios
        .post("http://localhost:8000/api/remover", data)

        .then(function (response) {
          alert(response.data.msg);
          self.reloadPage();
        })
        .catch(function () {
          console.log("Não foi possivel deletar o usuário");
        });
    },
    editar(id) {
      let self = this;
      event.preventDefault();
      const data = {
        nome: this.nome,
        email: this.email,
        cpf: this.cpf,
        nascimento: this.nascimento,
        id: id,
      };

      if (this.isValidCPF(data.cpf)) {
        this.axios
          .post("http://localhost:8000/api/editar", data)
          .then(function (response) {
            alert(response.data.msg);
            self.reloadPage();
            //console.log(response)
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
    reloadPage() {
      window.location.reload();
    },
    buscar(param) {
      let self = this;
      const data = {
        buscas: param,
      };
      this.axios
        .post("http://localhost:8000/api/pesquisa", data)
        .then(function (response) {
          var pesquisa = [];
          response.data.result.map(function (value, key) {
            pesquisa.push(value);
            (self.pesquisa = pesquisa), key;
            self.listar = false;
          });
          console.log(response);
        })
        .catch(function () {
          console.log("Erro ao salvar o usuário");
        });
    },
  },
};
</script>
<style>
.modal-footer {
  display: none !important;
}
</style>
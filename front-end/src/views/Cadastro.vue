<template>
  <div class="cadastro">
    <FormCadastro />
  </div>
</template>

<script>
// @ is an alias to /src
import FormCadastro from '@/components/formularios/FormCadastro.vue'

export default {
  name: 'Cadastro',
  components: {
    FormCadastro
  }
}
</script>

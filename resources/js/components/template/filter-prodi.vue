<template>
  <fieldset>
    <legend>Filter</legend>
    <form action="">
      <div class="row">
        <div class="col-lg-3">
          <div class="form-group">
            <label for="filter_tahun" class="control-label">Tahun</label>
            <multiselect v-model="tahunSelected" id="filter_tahun" name="tahun" :options="tahuns" track-by="tahun_id" label="nama_tahun" />
          </div>
        </div>
        <div class="col-lg-3">
          <div class="form-group">
            <label for="filter_prodi" class="control-label">Program Studi</label>
            <multiselect v-model="prodiSelected" id="filter_prodi" name="prodi" :options="prodis" track-by="kode_prodi" label="nama_prodi" />
          </div>
        </div>
      </div>
    </form>
  </fieldset>
</template>

<script>
  export default {
    props: [
      'prodi',
      'tahun',
    ],
    data: props => ({
      prodiSelected: null,
      tahunSelected: null,
      prodis: [],
      tahuns: [],
    }),
    watch: {
      'prodiSelected': function(value) {
        this.$emit('update:prodi', value ? value.kode_prodi : null)
      },
      'tahunSelected': function(value) {
        this.$emit('update:tahun', value ? value.tahun_id : null)
      },
    },
    mounted() {
      let sources = [
        ['prodis', '/data/akademik/resources/prodi'],
        ['tahuns', '/data/akademik/resources/tahun'],
      ]

      axios.all(sources.map(source => axios.get(source[1])))
        .then(responses => sources.forEach((v, i) => this[v[0]] = responses[i].data))
        .catch(e => {
          this.$swal({
            title: 'Data Loading Error',
            text: e.response ? e.response.data.message : e.message,
            type: 'error',
            confirmButtonText: 'OK',
          })
        })
      ;
    }
  }
</script>

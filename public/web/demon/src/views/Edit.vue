<template>
  <div>
    <div id="search">
      <el-input placeholder="键入关键词" v-model="key_words" @keyup.native.enter="query"></el-input><el-button icon="el-icon-search" @click="query"></el-button>
    </div>
    <div>
      <el-table
        :data="tableData"
        style="width: 100%" row-key="id">
        <el-table-column
          prop="id"
          label="ID"
          width="180">
        </el-table-column>
        <el-table-column
          prop="name"
          label="名称"
          width="180">
        </el-table-column>
        <el-table-column
          prop="product_id"
          label="货号">
        </el-table-column>
        <el-table-column
          prop="add_time"
          label="添加时间">
        </el-table-column>
        <el-table-column
          prop="create_user"
          label="添加人">
        </el-table-column>
        <el-table-column
        label="操作">
          <template slot-scope="scope">
            <el-button
              @click.native.prevent="deleteRow(scope.$index,scope.row.id,tableData)"
              type="text"
              size="small" icon="el-icon-delete">
              删除
            </el-button>
          </template>
        </el-table-column>
      </el-table>
      <el-dialog title="新增" :visible.sync="dialogTableVisible">
        <el-form label-position="right" size="small">
          <el-form-item label="ID" label-width="50px">
            <el-input v-model="newItem.id"></el-input>
          </el-form-item>
          <el-form-item label="名称" label-width="50px">
            <el-input v-model="newItem.name"></el-input>
          </el-form-item>
          <el-form-item label="货号" label-width="50px">
            <el-input v-model="newItem.item_no"></el-input>
          </el-form-item>
        </el-form>
        <el-button type="primary" @click="onSubmit">save</el-button>
          <el-button @click="dialogTableVisible=false">cancel</el-button>
      </el-dialog>
    </div>
<el-button @click="openDialog()" id="add">新增</el-button>
  </div>
</template>

<script>
import axios from 'axios'
import { query, addItem, deleteItem } from '../api/item'
import store from '../store'
axios.defaults.baseURL = process.env.VUE_APP_BASEURL
export default {
  name: 'Edit',
  data () {
    return {
      key_words: '',
      dialogTableVisible: false,
      newItem: { id: '', item_no: '', name: '' },
      tableData: []
    }
  },
  mounted () {
    this.feachNew()
    console.log(this.$store.state.token + 'cfgvbhnj')
    // var token = this.$store.state.token
    // if (token === '') {
    //   window.location = '/'
    // }
    document.title = '编辑'
  },
  methods: {
    feachNew: function () {
      query().then((Response) => {
        this.tableData = Response.data
      }).catch((Error) => {
        console.log(Error)
      })
    },
    onSubmit: function () {
      addItem({
        id: this.newItem.id,
        name: this.newItem.name,
        item_no: this.newItem.item_no
      }).then((Response) => {
        this.tableData.push(Response.data)
        this.$message({
          message: '新增成功!',
          type: 'success'
        })
      }).catch((error) => {
        this.$message({
          message: error,
          type: 'error'

        })
      })
      this.dialogTableVisible = false
    },
    deleteRow: function (index, id, tableData) {
      this.remoteDelete(index, id, tableData)
    },
    remoteDelete: function (index, id, tableData) {
      // todoindex
      deleteItem({ id: id }).then((Response) => {
        tableData.splice(index, 1)
      })
    },
    openDialog: function () {
      this.newItem.id = this.newItem.item_no = this.newItem.name = ''
      this.dialogTableVisible = true
    },
    getCookie: function (cname) {
      var name = cname + '='
      var ca = document.cookie.split(';')
      for (var i = 0; i < ca.length; i++) {
        var c = ca[i].trim()
        if (c.indexOf(name) === 0) return c.substring(name.length, c.length)
      }
      return ''
    },
    query: function () {
      query({ keywords: this.key_words }).then((Response) => {
        this.tableData = Response.data
        console.log(store.getters.token)
      }).catch((error) => {
        console.log(error)
      })
    }
  }
}
</script>

<style scoped>
.el-input{
  display: inline-block;
  width: 50%;
}
  #search .el-button{
    margin-left: 10px;
  }
  .el-table{
    margin-top: 15px;
  }
  #add{
    float: right;
    margin-top: 5px;
  }
</style>

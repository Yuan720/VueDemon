<template>
<el-container>
  <el-main>
    <div class="ct-box">
      <h3>登录</h3>
      <el-input placeholder="用户名" v-model="user.name"></el-input>
      <el-input placeholder="密码" v-model="user.psw" @keyup.native.enter="login"></el-input>
      <div id="tips">{{this.tips}}</div>
      <el-button type="primary" @click="login">login</el-button>
      <p class="tips">
        测试用户名:user 密码:test
      </p>
    </div>

  </el-main>
</el-container>
</template>

<script>
// @ is an alias to /src
import axios from 'axios'
import md5 from 'js-md5'
import { mapMutations } from 'vuex'
import Cookies from 'js-cookie'
import { login } from '../api/login'
axios.defaults.baseURL = process.env.VUE_APP_BASEURL
export default {
  data () {
    return {
      tips: '',
      user: {
        name: '',
        psw: ''
      }
    }
  },
  name: 'Home',
  components: {
  },
  methods: {
    ...mapMutations(['setToken']),
    login: function () {
      login({ name: this.user.name, paw: this.psw_hash }).then((Response) => {
        Cookies.set('x-token', Response.data)
        document.location = 'edit'
      }).catch((Error) => {
        console.log(Error)
      })
    }
  },
  computed: {
    psw_hash: function () {
      if (this.user.psw === '') {
        return ''
      }
      return md5(this.user.psw)
    }

  },
  mounted () {
    document.title = '登录'
  }
}
</script>
<style scoped="scoped">
  .el-input{
    margin-bottom: 50px;
  }
  .ct-box{
    float: right;
    width: 300px;
    background-color: white;
    padding: 50px;
    border-radius: 3px;
    padding-bottom: 200px;
  }
  h3{
    text-align: center;
    font-family: "Helvetica Neue",Helvetica,"PingFang SC","Hiragino Sans GB","Microsoft YaHei","微软雅黑",Arial,sans-serif;
    color: #4288ce;
  }
  .tips{
    color: gray;
    font-size: xx-small;
  }
  #tips{
    color: firebrick;
    display: block;
  }
</style>

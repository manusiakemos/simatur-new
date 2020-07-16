<template>
    <!--<el-submenu v-for="(value, index) in menu">
        <template slot="title">
            <i class="fa fa-chart-line"></i>
            <span>Dashboard</span>
        </template>
        <el-menu-item-group title="Group One">
            <el-menu-item index="dashboard">item one</el-menu-item>
            <el-menu-item index="dashboard2">item two</el-menu-item>
        </el-menu-item-group>
    </el-submenu>-->
    <!--{{menu}}-->
</template>

<script>
    export default {
        props:['menu'],
        name: 'Sidebar Children'
    }
</script>

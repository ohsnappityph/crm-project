<template>
  <v-app>
    <v-app-bar app color="purple darken-4">
      <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title class="text-uppercase">
        <nuxt-link :to="{name: 'dashboard'}" style="text-decoration: none; color: white;">
          <span class="font-weight-bold">FPV</span>
        </nuxt-link>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn icon>
        <v-icon>mdi-bell</v-icon>
      </v-btn>
      <v-btn icon>
        <v-icon>mdi-dots-vertical</v-icon>
      </v-btn>
    </v-app-bar>
    <v-navigation-drawer
      v-model="drawer"
      app
      floating
      mini-variant
      expand-on-hover
      color="grey darken-4"
      >
      <v-list dense>
        <v-list-item
          v-for="(item, i) in user"
          :key="i"
          :to="{name: item.route}"
          link
        >
          <v-list-item-action>
            <v-icon v-text="item.icon"></v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title v-text="item.title"></v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
      <v-divider></v-divider>
      <v-list dense>
        <v-list-item
          v-for="(item, i) in pages"
          :key="i"
          :to="{name: item.route}"
          link
        >
          <v-list-item-action>
            <v-icon v-text="item.icon"></v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title v-text="item.title"></v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
    <v-content>
      <div>
        <v-container fluid>
          <nuxt />
        </v-container>
      </div>
    </v-content>
    <v-footer app>
      <span class="px-4">&copy; {{ new Date().getFullYear() }}</span>
      <v-spacer></v-spacer>
      <span>Created by OhSnappityPH</span>
    </v-footer>
  </v-app>
</template>

<script>
export default {
  data: () => ({
    drawer:true,
    mini: true,
    user: [
      {
        icon: 'mdi-account-box',
        title: 'User',
        route: 'users'
      },
    ],
    pages: [
      {
        icon: 'mdi-view-dashboard',
        title: 'Dashboard',
        route: 'dashboard'
      },
      {
        icon: 'mdi-calendar-month',
        title: 'Scheduling',
        route: 'scheduling'
      },
      {
        icon: 'mdi-account',
        title: 'Clients',
        route: 'users-clients'
      },
      {
        icon: 'mdi-account-hard-hat',
        title: 'Surveyors',
        route: 'surveyors'
      },
      {
        icon: 'mdi-account-cash',
        title: 'Payrolls',
        route: 'payrolls'
      },
      {
        icon: 'mdi-chart-bar',
        title: 'Leads',
        route: 'leads'
      },
      {
        icon: 'mdi-view-dashboard-variant',
        title: 'Projects',
        route: 'projects'
      },
      {
        icon: 'mdi-email-multiple',
        title: 'Emailing',
        route: 'emailing'
      },
      {
        icon: 'mdi-chart-areaspline',
        title: 'Reporting',
        route: 'reporting'
      },
    ]
  }),
  methods: {

  },
  computed: {

  },
}
</script>

<style>

</style>

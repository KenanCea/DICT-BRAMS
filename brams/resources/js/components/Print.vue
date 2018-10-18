<template>
  <q-tabs>
  <!-- Tabs - notice slot="title" -->
  <q-tab default count="5" slot="title" name="tab-1" icon="message" />
  <q-tab disable slot="title" name="tab-2" icon="fingerprint" />
  <q-tab alert slot="title" name="tab-3" icon="account_box" />
  <q-tab slot="title" name="tab-4" icon="accessibility" />
  <q-tab slot="title" name="tab-5" icon="build" />

  <!-- Targets -->
  <q-tab-pane name="tab-1">Tab One</q-tab-pane>
  <q-tab-pane name="tab-2">Tab Two</q-tab-pane>
  <q-tab-pane name="tab-3">Tab Three</q-tab-pane>
  <q-tab-pane name="tab-4">Tab Four</q-tab-pane>
  <q-tab-pane name="tab-5">Tab Five</q-tab-pane>
</q-tabs>
</template>

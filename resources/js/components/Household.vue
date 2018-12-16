<template>
  <v-app>
    <v-container>
      <v-layout row wrap>
        <v-card>
          <v-card-title class="pb-0">
            <h1 class="font-weight-light">Household</h1>
            <v-divider class="ma-2" vertical></v-divider>
            <v-spacer></v-spacer>
            <v-text-field v-model="search" prepend-inner-icon="search" label="Search"></v-text-field>
            <v-menu offset-y>
              <v-btn slot="activator" color="primary" dark>Export</v-btn>
              <v-list>
                <v-list-tile v-for="(item, index) in exports" :key="index">
                  <button @click="exporting(item.title)">
                    <v-list-tile-title>{{ item.title }}</v-list-tile-title>
                  </button>
                </v-list-tile>
              </v-list>
            </v-menu>
            <v-menu v-model="menu" :close-on-content-click="false" offset-y>
              <v-btn slot="activator" color="primary" dark>Column</v-btn>
              <v-list>
                <v-list-tile v-for="(item, index) in headers" :key="index">
                  <v-switch></v-switch>
                  <v-list-tile-title>{{ item.title }}</v-list-tile-title>
                </v-list-tile>
              </v-list>
              <v-btn flat @click="menu = false">Cancel</v-btn>
              <v-btn color="primary" flat @click="menu = false">Save</v-btn>
            </v-menu>
          </v-card-title>
          <v-dialog v-model="dialog" scrollable>
            <v-btn slot="activator" absolute dark fab top right color="primary">
              <v-icon>add</v-icon>
            </v-btn>
            <v-card>
              <v-card-title>
                <span class="headline">{{ formTitle }}</span>
              </v-card-title>
              <v-divider></v-divider>
              <v-card-text>
                <v-container grid-list-md>
                  <v-layout wrap>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="editedItem.name" label="Dessert name"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="editedItem.calories" label="Calories"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="editedItem.fat" label="Fat (g)"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="editedItem.carbs" label="Carbs (g)"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="editedItem.protein" label="Protein (g)"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="editedItem.protein" label="Protein (g)"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="editedItem.protein" label="Protein (g)"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="editedItem.protein" label="Protein (g)"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="editedItem.protein" label="Protein (g)"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="editedItem.protein" label="Protein (g)"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="editedItem.protein" label="Protein (g)"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="editedItem.protein" label="Protein (g)"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="editedItem.protein" label="Protein (g)"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="editedItem.protein" label="Protein (g)"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="editedItem.protein" label="Protein (g)"></v-text-field>
                    </v-flex>
                    <v-flex xs12 sm6 md4>
                      <v-text-field v-model="editedItem.protein" label="Protein (g)"></v-text-field>
                    </v-flex>
                  </v-layout>
                </v-container>
              </v-card-text>
              <v-divider></v-divider>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="primary" @click="close">Cancel</v-btn>
                <v-btn color="primary" @click="save">Save</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
          <v-divider></v-divider>
          <v-data-table
            :headers="headers"
            :items="members"
            :search="search"
            item-key="name"
            class="fixed-header"
          >
            <template class="tableData" slot="items" slot-scope="props">
              <td>{{ props.item.id }}</td>
              <td>{{ props.item.first_name }}</td>
              <td>{{ props.item.middle_name }}</td>
              <td>{{ props.item.family_name }}</td>
              <td>{{ props.item.age }}</td>
              <td>{{ props.item.sex }}</td>
              <td>{{ props.item.created_at }}</td>
              <td>{{ props.item.updated_at }}</td>
              <td>
                <v-btn color="primary" class="mx-1" fab small dark @click="editItem(props.item)">
                  <v-icon>remove_red_eye</v-icon>
                </v-btn>
                <v-btn color="primary" class="mx-1" fab small dark @click="editItem(props.item)">
                  <v-icon>edit</v-icon>
                </v-btn>
                <v-btn color="primary" class="mx-1" fab small dark @click="deleteItem(props.item)">
                  <v-icon>delete</v-icon>
                </v-btn>
              </td>
            </template>
          </v-data-table>
        </v-card>
      </v-layout>
    </v-container>
  </v-app>
</template>
<script>
import menu from "./api/menu";
import * as jsPDF from 'jspdf';
import * as autoTable from 'jspdf-autotable';
import htmlDocx from 'html-docx-js/dist/html-docx';
import saveAs from 'file-saver';
export default {
  data: () => ({
    search: "",
    menu: false,
    exports: [{ title: "Word" }, { title: "PDF" }, { title: "Excel" }],
    dialog: false,
    headers: [
      { text: "ID", value: "id", width: "100px", title: "ID" },
      {
        text: "First name",
        value: "first_name",
        width: "200px",
        title: "First name"
      },
      {
        text: "Middle name",
        value: "middle_name",
        width: "200px",
        title: "Middle name"
      },
      {
        text: "Family name",
        value: "family_name",
        width: "200px",
        title: "Family name"
      },
      { text: "Age", value: "age", width: "100px", title: "Age" },
      { text: "Sex", value: "sex", width: "100px", title: "Sex" },
      {
        text: "Created at",
        value: "created_at",
        width: "200px",
        title: "Created at"
      },
      {
        text: "Updated at",
        value: "updated_at",
        width: "200px",
        title: "Updated at"
      },
      {
        text: "Actions",
        value: "name",
        sortable: false,
        fixed: true,
        width: "200px",
        title: "Actions"
      }
    ],
    desserts: [],
    members: [],
    editedIndex: -1,
    editedItem: {
      name: "",
      calories: 0,
      fat: 0,
      carbs: 0,
      protein: 0
    },
    defaultItem: {
      name: "",
      calories: 0,
      fat: 0,
      carbs: 0,
      protein: 0
    }
  }),
  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Inhabitant" : "Edit Item";
    }
  },
  watch: {
    dialog(val) {
      val || this.close();
    }
  },
  created() {
    this.loadMember();
    Fire.$on("AfterDo", () => {
      this.loadMember();
    });
  },
  methods: {
    loadMember() {
      this.$Progress.start();
      axios.get("api/member").then(({ data }) => {
        this.members = data.data;
        this.$Progress.finish();
      });
    },
    editItem(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },
    deleteItem(item) {
      const index = this.desserts.indexOf(item);
      confirm("Are you sure you want to delete this item?") &&
        this.desserts.splice(index, 1);
    },
    close() {
      this.dialog = false;
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      }, 300);
    },
    save() {
      if (this.editedIndex > -1) {
        Object.assign(this.desserts[this.editedIndex], this.editedItem);
      } else {
        this.desserts.push(this.editedItem);
      }
      this.close();
    },
    exporting(name){
      var copy = document.getElementsByClassName("v-datatable v-table theme--light")[0];
      var content = copy.cloneNode(true);
      
      //remove unnecessary columns
      for(var ctr=0; content.getElementsByTagName("TR")[ctr]!=null ;ctr++){
          content.getElementsByTagName("TR")[ctr].lastChild.remove();
      }
      //remove "arrow up" tag
      for(var ctr=0; content.getElementsByTagName("TH")[ctr] != null; ctr++){
        content.getElementsByTagName("TH")[ctr].removeChild(content.getElementsByTagName("I")[0]);
      }
      if(name == 'PDF'){
        var doc = new jsPDF('landscape','pt');
        var trial = doc.autoTableHtmlToJson(content);
        doc.setFontSize(10);
        doc.text(340, 50, 'Republic of the Philippines');
        doc.text(270, 70, 'Department of Information and Communications Technology');
        doc.text(330, 90, 'Cordillera Administrative Region');
        doc.setFontSize(20);
        doc.text(350, 115, 'Inhabitants');
        doc.autoTable(trial.columns, trial.data,{
            startY: 130}
            );
        doc.save("trial" + '.pdf');
      }
      if(name == 'Word'){
        var headings = "<div style='text-align: center'>Republic of the Philippines<br>Department of Information and Communications Technology<br>Cordillera Administrative Region<br>";
        var title = "<span style='font-size:30'>Inhabitant</div>";
        content.style.width = "100%";
        content.style.borderCollapse = "collapse";
        content.getElementsByTagName("TR")[0].style.backgroundColor = "#5c85d6";
        content.getElementsByTagName("TR")[0].style.color = "white";
        for(var ctr=0; content.getElementsByTagName("TR")[ctr]!=null ;ctr++){
            if(ctr%2==1){
                content.getElementsByTagName("TR")[ctr].style.backgroundColor = "#f2f2f2";
            }
        }
        var elem = document.createElement("Table");
        elem.appendChild(content);
        var converted = htmlDocx.asBlob(headings + title + elem.innerHTML,{
          orientation: 'landscape'
        });
        saveAs(converted, 'test.docx');
      }
    }
  }
};
</script>
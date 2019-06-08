<template id="app">
    <div> 
       <header id='printHeader'>
            <h1>REPUBLIC OF THE PHILIPPINES</h1>
            <h2> {{ reportshHeader.region }} </h2>
            <h2> {{ reportshHeader.name }} - {{reportshHeader.province}} </h2>
            <h3> {{ TableTitle }}</h3></header>

          <v-tooltip attach bottom>
            <template v-slot:activator="{ on }">
              <v-btn v-on="on" icon @click="print()">
                <v-icon>mdi-printer</v-icon>
              </v-btn>
            </template>
            <span>Print</span>
          </v-tooltip>
          <v-menu :close-on-content-click="false" offset-y max-height="400">
            <template #activator="{ on: menu }">
              <v-tooltip attach bottom>
                <template #activator="{ on: tooltip }">
                  <v-btn icon v-on="{ ...tooltip, ...menu }">
                    <v-icon>mdi-application-export</v-icon>
                  </v-btn>
                </template>
                <span>Export</span>
              </v-tooltip>
            </template>
            <v-list>
              <v-list-item @click="pdf()">
                <v-list-item-icon class="mr-2">
                  <v-icon color="red">mdi-file-pdf</v-icon>
                </v-list-item-icon>
                <v-list-item-content>
                  <v-list-item-title>PDF</v-list-item-title>
                </v-list-item-content>
              </v-list-item>
              <v-list-item @click="word()">
                <v-list-item-icon class="mr-2">
                  <v-icon color="blue">mdi-file-word</v-icon>
                </v-list-item-icon>
                <v-list-item-content>
                  <v-list-item-title>Word</v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </v-list>
          </v-menu>


        <!--<v-tooltip attach bottom>
          <template v-slot:activator="{ on }">
            <v-btn v-on="on" icon @click="print()">
              <v-icon>mdi-printer</v-icon>
            </v-btn>
          </template>
          <span>Print</span>
        </v-tooltip>
        <v-tooltip attach bottom>
          <template v-slot:activator="{ on }">
            <v-btn v-on="on" icon @click="word()">
              <v-icon>mdi-file-word</v-icon>
            </v-btn>
          </template>
          <span>Word</span>
        </v-tooltip>
        <v-tooltip attach bottom>
          <template v-slot:activator="{ on }">
            <v-btn v-on="on" icon @click="pdf()">
              <v-icon>mdi-file-pdf</v-icon>
            </v-btn>
          </template>
          <span>PDF</span>
        </v-tooltip>-->
    </div>
</template>

<script>
import htmlDocx from 'html-docx-js/dist/html-docx'
import { saveAs } from 'file-saver'
import { Printd } from 'printd'
import jsPDF from 'jspdf'
import 'jspdf-autotable'
const cssText = `
  #printHeader{
      display: block;
  }
  header{
      margin-left: 0;
      margin-right: 0;
  }
  h1{
      margin-bottom: 0;
      font-size: 20px;
      text-align: center;
  }
  h2{
      margin-top: 0;
      margin-bottom:0;
      font-size: 18px;
      text-align: center;
  }
  h3{
      margin-top: 20px;
      font-size: 22px;
      font-weight: bold;
      text-align: center;
  }
table th:nth-child(1),td:nth-child(1){
   display:none;
}
  table {
    font-family: Helvetica, Arial, sans-serif;
    border-collapse: 
    collapse; border-spacing: 0; 
    width:100%;
    }
    thead tr:nth-child(2) {display: none;}
    div div div:last-child {display: none;}
    td, th { border: 1px solid #CCC; height: 30px; font-size:12px;}
    th {  
        font-weight: bold; 
    }
    td {  
        text-align: center;
    }
    table thead tr th i{
        display: none;
    }
}
`
export default {
    data: () => ({
        reportshHeader: {}
    }),
    created() {
        this.display();
    },
    props:['TableTitle','PageOrientation'],
    methods: {
        display(){
            axios.get('api/header').then(response => {
                    this.reportshHeader = response.data[0] ;
                });
        },
        print() {
            var table = document.getElementById("printTable").cloneNode(true)
            var header = document.getElementById("printHeader").cloneNode(true)
            
            var div = document.createElement("div")
            div.appendChild(header)
            div.appendChild(table)
            const d = new Printd()
            d.print( div, [ cssText ] )
        },
        word(){
            var html = document.createElement('html')
            var head = document.createElement('head')
            var sheet = document.createElement('style')
            var div1 = document.createElement("div") 
            var table1 = document.getElementById("printTable").cloneNode(true)
            var header1 = document.getElementById("printHeader").cloneNode(true)
            table1.lastChild.remove()
            for(var ctr=0; table1.getElementsByTagName("TR")[ctr]!=null ;ctr++){
                table1.getElementsByTagName("TR")[ctr].firstChild.remove();
            }
            sheet.append(cssText)
            head.appendChild(sheet)
            div1.appendChild(header1)
            div1.appendChild(table1)
            html.appendChild(head)
            html.appendChild(div1)
            var converted = htmlDocx.asBlob(html.innerHTML,{orientation: this.PageOrientation})
            saveAs(converted,  this.TableTitle+'.docx')
        },
        pdf(){
            var table = document.getElementById("printTable").getElementsByTagName("table")[0].cloneNode(true)
            for(var ctr=0; table.getElementsByTagName("TR")[ctr]!=null ;ctr++){
                table.getElementsByTagName("TR")[ctr].firstChild.remove();
            }
            
            var doc = new jsPDF(this.PageOrientation,'pt');
            var width;
            if(this.PageOrientation == 'portrait'){
                width=295;
            }else{
                width=415;
            }
            doc.getFontList()
            doc.setFontType("bold");
            doc.setFont("Arial");
            
            doc.setFontSize(15)
            doc.text('REPUBLIC OF THE PHILIPPINES',width,70,'center')
            doc.setFontSize(13.5)
            doc.text('REGION',width,85,'center')
            doc.text('BARANGAY-PROVINCE',width, 98.5,'center')
            doc.setFontSize(16.5)
            doc.text(this.TableTitle, width, 140, 'center')
            doc.autoTable({html: table,
                theme: 'plain',
                startY: 165,
                styles:{cellPadding:5,fontSize:9},
                headStyles:{halign:'center',lineWidth:1},
                bodyStyles:{halign:'center',valign:'middle',lineWidth:1,font: 'helvetica'}
            }  
            );
            doc.save(this.TableTitle + ".pdf");
        }
    }
}
</script>
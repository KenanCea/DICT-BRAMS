<template id="app">
    <div> 

          <v-tooltip attach bottom>
            <template v-slot:activator="{ on }">
              <v-btn v-on="on" icon @click="print()">
                <v-icon>mdi-printer</v-icon>
              </v-btn>
            </template>
            <span>Print</span>
          </v-tooltip>
    </div>
</template>

<script>
import { Printd } from 'printd'
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


  table {
    font-family: Helvetica, Arial, sans-serif;
    border-collapse: 
    collapse; border-spacing: 0; 
    width:100%;
    }

    td, th { border: 1px solid #CCC; height: 20px; font-size:12px;}

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
    props:['TableTitle','PageOrientation'],
    methods: {
        print() {
            var table = document.getElementById("printKiosk").cloneNode(true)
            
            var div = document.createElement("div")
            div.appendChild(table)
            const d = new Printd()
            d.print( div, [ cssText ] )
        },
    }
}
</script>
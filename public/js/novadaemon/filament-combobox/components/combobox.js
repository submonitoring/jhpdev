function g({options:n,selected:r,statePath:d,wire:h}){return{options:[],selected:[],optionsOriginal:[],selectedOriginal:[],allOptions:[],wire:h,statePath:d,searchState:{options:{active:!1,keyword:""},selected:{active:!1,keyword:""}},init:function(){this.allOptions=n,this.prepareInitialData(),this.syncDisplayWithMaster()},prepareInitialData:function(){this.optionsOriginal=[],this.selectedOriginal=[],n.forEach(e=>{let t={value:e.value,label:e.label,highlighted:!1};r.includes(e.value)?this.selectedOriginal.push(t):this.optionsOriginal.push(t)})},syncDisplayWithMaster:function(){if(this.searchState.options.active){let e=this.searchState.options.keyword.toLowerCase();this.options=this.optionsOriginal.filter(t=>t.label.toLowerCase().includes(e))}else this.options=[...this.optionsOriginal];if(this.searchState.selected.active){let e=this.searchState.selected.keyword.toLowerCase();this.selected=this.selectedOriginal.filter(t=>t.label.toLowerCase().includes(e))}else this.selected=[...this.selectedOriginal]},search:function(e,t){this.searchState[e].keyword=t,this.searchState[e].active=t.length>0,this.syncDisplayWithMaster()},toggleHighlight:function(e,t){this[e][t].highlighted=!this[e][t].highlighted},moveItem:function(e,t,i){let s=t==="options"?"optionsOriginal":"selectedOriginal",l=i==="options"?"optionsOriginal":"selectedOriginal";if(this[l].find(a=>a.value===e.value))return;let c=this[s].find(a=>a.value===e.value);c&&(this[s]=this[s].filter(a=>a.value!==e.value),this[l].push({...c,highlighted:!1}),this.syncDisplayWithMaster(),this.updateState())},moveToRight:function(){this.options.filter(t=>t.highlighted).forEach(t=>{let i=this.optionsOriginal.find(s=>s.value===t.value);i&&this.moveItem(i,"options","selected")})},moveToLeft:function(){this.selected.filter(t=>t.highlighted).forEach(t=>{let i=this.selectedOriginal.find(s=>s.value===t.value);i&&this.moveItem(i,"selected","options")})},moveToRightAll:function(){let e=this.searchState.options.active?this.options:this.optionsOriginal;e.forEach(t=>{let i=this.optionsOriginal.find(s=>s.value===t.value);i&&!this.selectedOriginal.some(s=>s.value===t.value)&&this.selectedOriginal.push({...i,highlighted:!1})}),this.optionsOriginal=this.optionsOriginal.filter(t=>!e.some(i=>i.value===t.value)),this.searchState.options.active||(this.searchState.options.keyword=""),this.syncDisplayWithMaster(),this.updateState()},moveToLeftAll:function(){let e=this.searchState.selected.active?this.selected:this.selectedOriginal;if(e.forEach(t=>{let i=this.selectedOriginal.find(s=>s.value===t.value);i&&!this.optionsOriginal.some(s=>s.value===t.value)&&this.optionsOriginal.push({...i,highlighted:!1})}),this.searchState.selected.active){let t=new Set(e.map(i=>i.value));this.selectedOriginal=this.selectedOriginal.filter(i=>!t.has(i.value))}else this.selectedOriginal=[];this.searchState.selected.active||(this.searchState.selected.keyword=""),this.syncDisplayWithMaster(),this.updateState()},updateState:function(){this.optionsOriginal=[...new Map(this.optionsOriginal.map(t=>[t.value,t])).values()],this.selectedOriginal=[...new Map(this.selectedOriginal.map(t=>[t.value,t])).values()];let e=(t,i)=>{let s=this.allOptions.findIndex(o=>o.value===t.value),l=this.allOptions.findIndex(o=>o.value===i.value);return s-l};this.optionsOriginal.sort(e),this.selectedOriginal.sort(e),this.syncDisplayWithMaster(),h.dispatchFormEvent("filament-combobox::updateState",this.statePath,this.selectedOriginal)}}}export{g as default};

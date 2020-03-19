## Simple Table Component

> Tags: React | Component | Table 

### Description
A simpe react component for displaying data to the web page. The interface is minimal and easy to use. The users of this component have to provide data to the component and it will automatically render the data for you 😁  

### Functionality
- Render Columns.
- Render Data.
- Delete Row.
- Edit Row.

### Inputs
- columns | List of String | required
- data | List of Objects | required
- onEdit | type function | optional
- onDelete | type function | optional

### Usage
```js
// React Boiler Plate
import React from 'react';
import ReactDOM from 'react-dom';

// STEP: 1. Import the Component
import Table from './components/table'

// STEP: 2. Create Component by providing data.
const table = <Table columns={['ColId1','Col2','Col3']}
  data={[
    {_id: 1, name: 'Jon', city: 'New York'},
    {_id: 2, name: 'Doe', city: 'Paris'},
    {_id: 3, name: 'Smith', city: 'London'}
  ]}
  onEdit={(row)=>{console.log('Editing: ', row)}}
  onDelete={(row)=>{console.log('Deleting: ', row)}}
/>

// STEP: 3. Mount that component.
ReactDOM.render(table,document.getElementById('root'));
```

### Technology Used
- HTML-5
- Bootstrap 4.4.1
- Fontawesome 4.7.0
- React 16.3.0

### UI
![table-view-screenshot](./img/table.png 'Simple React Table Component')
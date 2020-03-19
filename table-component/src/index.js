import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import 'bootstrap/dist/css/bootstrap.css';
import 'font-awesome/css/font-awesome.css';


import Provider from './service/person';
import Table from './components/table';

const provider = new Provider();


// TODO: SECONDARY: Add color Scemes.
// TODO: SECONDARY: Add filtering by typing.

ReactDOM.render(<Table columns={provider.getProperties()}
  data={provider.getAll()}
  onEdit={(row) => { console.log('On Edit Clicked', row) }}
  onDelete={(row) => { console.log('On Delete Clicked', row) }}
/>, document.getElementById('root'));
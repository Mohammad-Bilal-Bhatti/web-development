import React, { Component } from 'react'

class Table extends Component {

  state = {
    // --------------------- STYLES -------------------------
    // ------------------------------------------------------
    tableClasses: 'table table-hover',
    theadClasses: 'thead-dark',
    tableResponsiveClasses: 'table-responsive-sm',
    editBtnClasses: 'btn btn-secondary',
    deleteBtnClasses: 'btn btn-danger',
    addBtnClasses: 'btn btn-outline-primary',
    addBtnIcon: 'fa fa-plus',
    editIcon: 'fa fa-edit',
    deleteIcon: 'fa fa-trash',
    // ------------------------------------------------------

    colnames: this.props.columns, // Get Dynamic Colomns names 
    data: this.props.data // Get Dymanic Data values 

  }

  handleDelete = (row) => {
    const stateModified = this.state;
    stateModified.data = stateModified.data.filter(r => r !== row);
    this.setState(stateModified);
    this.props.onDelete(row); // Call onDelete() function  
  };


  handleAdd = (row) => {
    const stateModified = this.state;
    stateModified.data.push(row);
    this.setState(stateModified);
  };

  handleEdit = (row) => {
    this.props.onEdit(row); // Call onEdit() function
  };

  render() {
    return (
      <div className={this.state.tableResponsiveClasses}>
        <table className={this.state.tableClasses}>
          <thead className={this.state.theadClasses}>
            <tr>
              {/* Render Columns Names */}
              {this.state.colnames.map(name => <th scope='col'>{name}</th>)}
              {/* Render Edit Column if onEdit is set */}
              {(this.props.onEdit) ? <th scope='col'>Edit</th> : ''}
              {/* Render Delete Column if onDelete is set */}
              {(this.props.onDelete) ? <th scope='col'>Delete</th> : ''}
            </tr>
          </thead>
          <tbody>
            {/* Map the each row with-in <tr> TAG*/}
            {this.state.data.map(row =>
              <tr>{
                // Render each Attributes Value with-in <td> TAG
                Object.keys(row).map(attribute => <td>{(typeof row[attribute] === 'object') ? row[attribute][Object.keys(row[attribute])[0]] : row[attribute]}</td>)
              }
                {/* Render Edit Button if 'onEdit' is set*/}
                {(this.props.onEdit) ? <td><button onClick={() => { this.handleEdit(row) }} className={this.state.editBtnClasses}><span className={this.state.editIcon}></span></button></td> : ''}
                {/* Render Delete Button if 'onDelete' is set*/}
                {(this.props.onDelete) ? <td><button onClick={() => { this.handleDelete(row) }} className={this.state.deleteBtnClasses}><span className={this.state.deleteIcon}></span></button></td> : ''}
              </tr>)}
          </tbody>
        </table>
        <div className="text-center mb-4">
          {/* Render Add New Button  */}
          <button onClick={this.addDummyData} className={this.state.addBtnClasses}><span className={this.state.addBtnIcon}></span> Add</button>
        </div>
      </div>
    );
  }
}

export default Table;
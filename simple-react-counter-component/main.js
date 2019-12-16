// Counter Class.
class Counter extends React.Component{
	render(){
		const myStyle={
			fontSize: "1.5em"
		};
		return(
			<div>
				<button onClick={this.props.onIncrement} className="btn btn-primary btn-sm m-2 px-4">Add</button>
				<button onClick={this.props.onDelete} className="btn btn-danger btn-sm m-2 px-4">Delete</button>
				<span style={myStyle} className="m-2 badge badge-warning badge-pill p-2">{this.props.count}</span>
			</div>
		);
	}
}

// Counters Clsss...
// This Class Encapsulates Counters...

class Counters extends React.Component{

	handleDelete(counter){
		
		// Filter that deleted Item from the counters list...
		const newCounters = this.state.counters.filter(item=>{
			if(item.id === counter.id){
				return false;
			}
			return true;
		});
		
		const total = this.calculateTotalItems(newCounters);
		
		// Setting the state of the component so that React can identify the change was made.
		this.setState(
			{
				totalCount: total,
				counters: newCounters
			}
		);
		
	}
	
	handleIncrement(counter){

		// Cloning the Counter Object.
		const newCountItem = {...counter}
		// Now Changing its count value.
		newCountItem.count++;  
		// Making new Counters list and a change the counter whole onIncrement button is clicked. 
		const newCounters = this.state.counters.map(counterItem=>(counterItem.id === counter.id)? newCountItem:counterItem);

		const total = this.calculateTotalItems(newCounters);
		
		
		// Setting the state of the component so that React can identify the change was made.
		this.setState(
			{
				totalCount:total,
				counters:newCounters
			}
		);
	}
	
	calculateTotalItems(newCounters){
		let totalCount = 0;
		
		// For each index in new Counters.
		for(let index in newCounters){
			totalCount+= newCounters[index].count;
		}
		return totalCount;
	}
	
	addCounter(){
		// Make a new instance of the Counter and add it to the list.
		
		const ctrs = this.state.counters;
		const len = ctrs.length;

		
		// Making New counter Object.
		const newCounter = {
			id: (len === 0)? 1: ctrs[ len -1 ].id + 1,
			count: 0
		}
		
		// Adding to the Counters list.
		const newCounters = [...ctrs,newCounter];

		const totalCount = this.calculateTotalItems(newCounters);
		
		// Let the react know that item is changed.
		this.setState(
			{
				totalCount:totalCount,
				counters: newCounters
			}
		);
	}
	state = {
		totalCount: 0,
		counters: [
		]
		
	}
	render(){
		return(
			<React.Fragment>
				<div>
					<button onClick={()=>this.addCounter()} className="btn btn-outline-success mx-1 mt-2"><span className="fas fa-plus"></span></button>
				</div>	
				{this.state.counters.map(item=><Counter onIncrement={()=>this.handleIncrement(item)} onDelete={()=>this.handleDelete(item)} key={item.id} count={item.count} />)}
				<div className="m-2 lead">Total Items
					<span className="badge badge-secondary badge-pill mx-3">{this.state.totalCount}</span>
				</div>
			</React.Fragment>
		);
	}
}

ReactDOM.render(
	<Counters />,
	document.getElementById('root')
);
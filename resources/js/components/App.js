import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import { BrowserRouter, Route, Switch } from 'react-router-dom'
import Header from './Header'
import NewRecipe from './NewRecipe'
import RecipesList from './RecipesList'
import ViewRecipe from './ViewRecipe'
import {LoginPage} from "./LoginPage";

class App extends Component {
  constructor (props) {
    super(props)

    this.state = {
      isLoggedIn: false,
      user: {}
    };
  }

  render () {
    return (
      <BrowserRouter>
        <div>
          <Header />
          <Switch>
            <Route exact path='/login' component={LoginPage} />
            <Route exact path='/recipes' component={RecipesList} />
            <Route path='/create' component={NewRecipe} />
            <Route path='/:id' component={ViewRecipe} />
          </Switch>
        </div>
      </BrowserRouter>
    )
  }
}

ReactDOM.render(<App />, document.getElementById('app'))

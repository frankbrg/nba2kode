
private getCall(){
    let url="http://localhost:8888/nba2kode/?page=json";
        console.log("Entered FetchHeadlines");

        this.http.get(url).subscribe((response)=>{
            console.log("Response1",response);
            console.log("Response2",response.json());   //here got json value you can assign value to variable.         
        })
}
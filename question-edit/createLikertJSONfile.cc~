//-------------------------------------------------------
//
// A program to create a json file from the likert
// text file
//
//-------------------------------------------------------

#include <iostream>
#include <fstream>
#include <string>

using namespace std;

int main()
{
  ifstream infile;
  ofstream outfile;

  int i = 1;
  int j = 1;
  string line = "";
  string noComma = "";
  string holder = "";
  string question = "question";

  infile.open("likertQuestions.txt");
  if(infile.fail())
  {
    cerr << "Error opening likert file!" << endl;
    exit(EXIT_FAILURE);
  }

  outfile.open("temp.json");
  if (outfile.fail())
  {
    cerr << "Error opening output file!" << endl;
    exit(EXIT_FAILURE);
  }

  /*
  while(getline(infile, line))
  {
    if(i%2 == 0)
    {
      outfile << line << endl;
    }else{
      outfile << j << endl;
      j++;
    }
    i++;
  }
  */

  i = 0;
  outfile << "{" << endl;

  while(getline(infile, line))
  {
    if(i % 2 == 0)
    {
      line = '"' + question + line + '"' + ":";
      outfile << line;
      holder = line;
    }
    else
    {
      line = line + ",";
      outfile << line << endl;
      holder += line;
    }
    i++;
  }

  outfile << "}" << endl;
  infile.close();
  outfile.close();

//-------------------------------------------------------

  noComma = holder.substr(0, holder.size()-1);

  infile.open("temp.json");
  if(infile.fail())
  {
    cerr << "Error opening temp file!" << endl;
    exit(EXIT_FAILURE);
  }

  outfile.open("../likert/likertQuestions.json");
  if(outfile.fail())
  {
    cerr << "Error opening temp file!" << endl;
    exit(EXIT_FAILURE);
  }

  while(getline(infile, line))
  {
    if(line == holder)
    {
      outfile << noComma << endl;
    }
    else{
      outfile << line << endl;
    }
  }

  infile.close();
  outfile.close();

  return 0;
}
